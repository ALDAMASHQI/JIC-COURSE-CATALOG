@extends('layouts.app_admin')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Student Management</h1>
        <p class="page-description">Manage all students, their profiles, and academic information</p>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Toolbar -->
        <div class="toolbar">

            <div class="toolbar-filters">
                <form method="GET" action="{{ route('admin.students.index') }}" class="d-flex gap-2 align-items-center">


                    <select name="major" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">All Majors</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->Major_ID }}" {{ request('major') == $major->Major_ID ? 'selected' : '' }}>
                                {{ $major->Major_Name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="">All Students</option>
                        <option value="with_ratings" {{ request('status') == 'with_ratings' ? 'selected' : '' }}>With Ratings</option>
                        <option value="without_ratings" {{ request('status') == 'without_ratings' ? 'selected' : '' }}>Without Ratings</option>
                    </select>

                    <select name="sort" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email A-Z</option>
                        <option value="ratings" {{ request('sort') == 'ratings' ? 'selected' : '' }}>Most Ratings</option>
                    </select>

                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search students..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    @if(request()->anyFilled(['search', 'major', 'status', 'sort']))
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="toolbar-actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-person-plus"></i>
                    Add New Student
                </button>
            </div>

        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Students Table -->
        <div class="students-table-container">
            <div class="table-header">
                <h3 class="table-title">All Students ({{ $students->total() }})</h3>
                <div class="table-controls">
                    <span class="text-muted">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover students-table">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Student Info</th>
                        <th>Major</th>
                        <th>Ratings</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $student)
                        <tr class="student-row">
                            <td>
                                <span class="student-id">#{{ $student->Student_ID }}</span>
                            </td>
                            <td>
                                <div class="student-info">
                                    <h6 class="student-name mb-1">{{ $student->Student_Name }}</h6>
                                    <p class="student-email mb-0 text-muted small">
                                        <i class="bi bi-envelope me-1"></i>{{ $student->Student_Email }}
                                    </p>
                                </div>
                            </td>
                            <td>
                                @if($student->major)
                                    <span class="major-badge">
                                        <i class="bi bi-journal-text me-1"></i>
                                        {{ $student->major->Major_Name }}
                                    </span>
                                    <div class="small text-muted mt-1">
                                        {{ $student->major->department->Dept_Name ?? 'N/A' }}
                                    </div>
                                @else
                                    <span class="text-muted small">Not assigned</span>
                                @endif
                            </td>
                            <td>
                                <div class="ratings-info">
                                    <span class="badge bg-info ratings-count">
                                        <i class="bi bi-star me-1"></i>{{ $student->course_ratings_count }}
                                    </span>
                                    @if($student->course_ratings_count > 0)
                                        <div class="small text-muted mt-1">Course Ratings</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editStudentModal{{ $student->Student_ID }}"
                                            title="Edit Student">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteStudentModal{{ $student->Student_ID }}"
                                            title="Delete Student">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info btn-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewStudentModal{{ $student->Student_ID }}"
                                            title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Student Modal for each student -->
                        <div class="modal fade" id="editStudentModal{{ $student->Student_ID }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->Student_ID }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editStudentModalLabel{{ $student->Student_ID }}">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit Student: {{ $student->Student_Name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.students.update', $student->Student_ID) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editStudentName{{ $student->Student_ID }}" class="form-label">Student Name *</label>
                                                    <input type="text" class="form-control" id="editStudentName{{ $student->Student_ID }}"
                                                           name="Student_Name" value="{{ $student->Student_Name }}" required
                                                           placeholder="Enter student full name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editStudentEmail{{ $student->Student_ID }}" class="form-label">Student Email *</label>
                                                    <input type="email" class="form-control" id="editStudentEmail{{ $student->Student_ID }}"
                                                           name="Student_Email" value="{{ $student->Student_Email }}" required
                                                           placeholder="Enter student email">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editUsername{{ $student->Student_ID }}" class="form-label">Username *</label>
                                                    <input type="text" class="form-control" id="editUsername{{ $student->Student_ID }}"
                                                           name="Username" value="{{ optional($student->user)->Username }}" required
                                                           placeholder="Enter username">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editEmail{{ $student->Student_ID }}" class="form-label">Login Email *</label>
                                                    <input type="email" class="form-control" id="editEmail{{ $student->Student_ID }}"
                                                           name="Email" value="{{ optional($student->user)->Email }}" required
                                                           placeholder="Enter login email">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="editPassword{{ $student->Student_ID }}" class="form-label">New Password</label>
                                                    <input type="password" class="form-control" id="editPassword{{ $student->Student_ID }}"
                                                           name="password" placeholder="Leave blank to keep current password">
                                                    <div class="form-text">Minimum 8 characters</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="editPasswordConfirmation{{ $student->Student_ID }}" class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" id="editPasswordConfirmation{{ $student->Student_ID }}"
                                                           name="password_confirmation" placeholder="Confirm new password">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="editMajorID{{ $student->Student_ID }}" class="form-label">Major</label>
                                                <select class="form-select" id="editMajorID{{ $student->Student_ID }}" name="Major_ID">
                                                    <option value="">No Major Assigned</option>
                                                    @foreach($majors as $major)
                                                        <option value="{{ $major->Major_ID }}"
                                                            {{ $student->Major_ID == $major->Major_ID ? 'selected' : '' }}>
                                                            {{ $major->Major_Name }} ({{ $major->department->Dept_Name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="student-info-card">
                                                <div class="info-item">
                                                    <span class="info-label">Student ID:</span>
                                                    <span class="info-value">#{{ $student->Student_ID }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">User ID:</span>
                                                    <span class="info-value">#{{ optional($student->user)->User_ID }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Total Ratings:</span>
                                                    <span class="info-value">{{ $student->course_ratings_count }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Account Created:</span>
                                                    <span class="info-value">{{ $student->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- View Student Modal for each student -->
                        <div class="modal fade" id="viewStudentModal{{ $student->Student_ID }}" tabindex="-1" aria-labelledby="viewStudentModalLabel{{ $student->Student_ID }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewStudentModalLabel{{ $student->Student_ID }}">
                                            <i class="bi bi-person-badge me-2"></i>
                                            Student Details: {{ $student->Student_Name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Personal Information</h6>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Student ID:</span>
                                                        <span class="detail-value">#{{ $student->Student_ID }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Full Name:</span>
                                                        <span class="detail-value">{{ $student->Student_Name }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Student Email:</span>
                                                        <span class="detail-value">{{ $student->Student_Email }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Major:</span>
                                                        <span class="detail-value">
                                                            @if($student->major)
                                                                <span class="badge bg-primary">{{ $student->major->Major_Name }}</span>
                                                            @else
                                                                <span class="text-muted">Not assigned</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Account Information</h6>
                                                    <div class="detail-item">
                                                        <span class="detail-label">User ID:</span>
                                                        <span class="detail-value">#{{ optional($student->user)->User_ID }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Username:</span>
                                                        <span class="detail-value">{{ optional($student->user)->Username }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Login Email:</span>
                                                        <span class="detail-value">{{optional($student->user)->Email }}</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="detail-card">
                                                    <h6>Activity & Statistics</h6>
                                                    <div class="row text-center">
                                                        <div class="col-md-4">
                                                            <div class="stat-item">
                                                                <div class="stat-value text-primary">{{ $student->course_ratings_count }}</div>
                                                                <div class="stat-label">Course Ratings</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="stat-item">
                                                                <div class="stat-value text-success">
                                                                    @if($student->major)
                                                                        {{ $student->major->Required_Credits }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </div>
                                                                <div class="stat-label">Required Credits</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="stat-item">
                                                                <div class="stat-value text-info">
                                                                    {{ $student->created_at->diffForHumans() }}
                                                                </div>
                                                                <div class="stat-label">Member Since</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->Student_ID }}">
                                            <i class="bi bi-pencil me-1"></i> Edit Student
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for each student -->
                        <div class="modal fade" id="deleteStudentModal{{ $student->Student_ID }}" tabindex="-1" aria-labelledby="deleteStudentModalLabel{{ $student->Student_ID }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="delete-modal-icon text-warning">
                                            <i class="bi bi-exclamation-triangle display-4"></i>
                                        </div>
                                        <h4 class="delete-modal-title mt-3">Delete Student</h4>

                                        @if($student->course_ratings_count > 0)
                                            <div class="alert alert-warning mt-3">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                This student has {{ $student->course_ratings_count }} course rating(s).
                                            </div>
                                            <p class="delete-modal-text text-muted">
                                                You cannot delete <strong>{{ $student->Student_Name }}</strong> because they have submitted course ratings.
                                                Please delete their ratings first before deleting the student account.
                                            </p>
                                            <div class="d-flex justify-content-center gap-3 mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewStudentModal{{ $student->Student_ID }}">
                                                    View Details
                                                </button>
                                            </div>
                                        @else
                                            <p class="delete-modal-text text-muted">
                                                Are you sure you want to delete <strong>{{ $student->Student_Name }}</strong>?
                                                This will permanently remove the student account and all associated data.
                                            </p>
                                            <form action="{{ route('admin.students.destroy', $student->Student_ID) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-3 mt-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete Student</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-people display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No students found</h5>
                                    <p class="text-muted mb-4">Get started by adding your first student.</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                        <i class="bi bi-person-plus"></i> Add New Student
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($students->hasPages())
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info text-muted">
                            Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students
                        </div>
                        <nav>
                            {{ $students->withQueryString()->links('vendor.pagination.bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">
                        <i class="bi bi-person-plus me-2"></i>
                        Add New Student
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.students.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Student_Name" class="form-label">Student Name *</label>
                                <input type="text" class="form-control" id="Student_Name" name="Student_Name"
                                       placeholder="Enter student full name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Student_Email" class="form-label">Student Email *</label>
                                <input type="email" class="form-control" id="Student_Email" name="Student_Email"
                                       placeholder="Enter student email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Username" class="form-label">Username *</label>
                                <input type="text" class="form-control" id="Username" name="Username"
                                       placeholder="Enter username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Login Email *</label>
                                <input type="email" class="form-control" id="Email" name="Email"
                                       placeholder="Enter login email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Enter password" required>
                                <div class="form-text">Minimum 8 characters</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation" placeholder="Confirm password" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Major_ID" class="form-label">Major</label>
                            <select class="form-select" id="Major_ID" name="Major_ID">
                                <option value="">No Major Assigned</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->Major_ID }}">
                                        {{ $major->Major_Name }} ({{ $major->department->Dept_Name }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">You can assign a major later if needed</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .student-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .student-id {
            background-color: #e9ecef;
            color: #495057;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .student-info .student-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .student-info .student-email {
            font-size: 0.875rem;
        }

        .login-info {
            font-size: 0.875rem;
        }

        .major-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .ratings-count {
            font-size: 0.8rem;
            padding: 8px 10px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .action-buttons .btn {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .student-info-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }

        .info-item {
            display: flex;
            justify-content: between;
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        .info-value {
            color: #6c757d;
            font-weight: 600;
        }

        .detail-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
        }

        .detail-card h6 {
            color: #495057;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .detail-item {
            display: flex;
            justify-content: between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        .detail-value {
            color: #6c757d;
            font-weight: 600;
        }

        .stat-item {
            padding: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .empty-state {
            padding: 3rem 1rem;
        }

        .delete-modal-icon {
            margin-bottom: 1rem;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .toolbar-filters {
                flex-direction: column;
                gap: 10px;
            }

            .toolbar-filters .d-flex {
                flex-wrap: wrap;
            }

            .toolbar-filters .form-select,
            .toolbar-filters .input-group {
                width: 100% !important;
            }
        }
    </style>
@endpush
