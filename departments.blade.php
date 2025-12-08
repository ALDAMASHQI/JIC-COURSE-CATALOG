@extends('layouts.app_admin')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Department Management</h1>
        <p class="page-description">Manage all departments and their associated majors</p>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Toolbar -->
        <div class="toolbar">


            <div class="toolbar-filters">
                <form method="GET" action="{{ route('admin.departments.index') }}" class="d-flex gap-2 align-items-center">


                    <select name="sort" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="majors" {{ request('sort') == 'majors' ? 'selected' : '' }}>Most Majors</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                    <div class="input-group" style="width: 250px;">
                        <input type="text" name="search" class="form-control" placeholder="Search departments..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    @if(request()->anyFilled(['search', 'sort']))
                        <a href="{{ route('admin.departments.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="toolbar-actions">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                    <i class="bi bi-building-add"></i>
                    Add New Department
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

        <!-- Departments Table -->
        <div class="departments-table-container">
            <div class="table-header">
                <h3 class="table-title">All Departments ({{ $departments->total() }})</h3>
                <div class="table-controls">
                    <span class="text-muted">Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} departments</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover departments-table">
                    <thead class="table-light">
                    <tr>
                        <th >ID</th>
                        <th>Department Name</th>
                        <th >Majors Count</th>
                        <th >Associated Majors</th>
                        <th >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($departments as $department)
                        <tr class="department-row">
                            <td>
                                <span class="department-id">#{{ $department->Dept_ID }}</span>
                            </td>
                            <td>
                                <div class="department-info">
                                    <h6 class="department-name mb-1">{{ $department->Dept_Name }}</h6>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary majors-count">
                                    <i class="bi bi-journals me-1"></i>{{ $department->majors_count }}
                                </span>
                            </td>
                            <td>
                                <div class="associated-majors">
                                    @if($department->majors->count() > 0)
                                        @foreach($department->majors->take(3) as $major)
                                            <span class="major-badge">{{ $major->Major_Name }}</span>
                                        @endforeach
                                        @if($department->majors->count() > 3)
                                            <span class="more-majors">+{{ $department->majors->count() - 3 }} more</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">No majors</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDepartmentModal{{ $department->Dept_ID }}"
                                            title="Edit Department">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteDepartmentModal{{ $department->Dept_ID }}"
                                            title="Delete Department">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info btn-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewDepartmentModal{{ $department->Dept_ID }}"
                                            title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Department Modal for each department -->
                        <div class="modal fade" id="editDepartmentModal{{ $department->Dept_ID }}" tabindex="-1" aria-labelledby="editDepartmentModalLabel{{ $department->Dept_ID }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDepartmentModalLabel{{ $department->Dept_ID }}">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit Department
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.departments.update', $department->Dept_ID) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editDeptName{{ $department->Dept_ID }}" class="form-label">Department Name *</label>
                                                <input type="text" class="form-control" id="editDeptName{{ $department->Dept_ID }}"
                                                       name="Dept_Name" value="{{ $department->Dept_Name }}" required
                                                       placeholder="Enter department name">
                                            </div>
                                            <div class="department-info-card">
                                                <div class="info-item">
                                                    <span class="info-label">Department ID:</span>
                                                    <span class="info-value">#{{ $department->Dept_ID }}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Total Majors:</span>
                                                    <span class="info-value">{{ $department->majors_count }}</span>
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

                        <!-- View Department Modal for each department -->
                        <div class="modal fade" id="viewDepartmentModal{{ $department->Dept_ID }}" tabindex="-1" aria-labelledby="viewDepartmentModalLabel{{ $department->Dept_ID }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDepartmentModalLabel{{ $department->Dept_ID }}">
                                            <i class="bi bi-building me-2"></i>
                                            Department Details: {{ $department->Dept_Name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Basic Information</h6>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Department ID:</span>
                                                        <span class="detail-value">#{{ $department->Dept_ID }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Department Name:</span>
                                                        <span class="detail-value">{{ $department->Dept_Name }}</span>
                                                    </div>
                                                    <div class="detail-item">
                                                        <span class="detail-label">Total Majors:</span>
                                                        <span class="detail-value badge bg-primary">{{ $department->majors_count }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="detail-card">
                                                    <h6>Associated Majors</h6>
                                                    @if($department->majors->count() > 0)
                                                        <div class="majors-list">
                                                            @foreach($department->majors as $major)
                                                                <div class="major-item">
                                                                    <i class="bi bi-journal-text text-primary me-2"></i>
                                                                    <span>{{ $major->Major_Name }}</span>
                                                                    <small class="text-muted ms-2">({{ $major->Required_Credits }} credits)</small>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-muted mb-0">No majors associated with this department.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDepartmentModal{{ $department->Dept_ID }}">
                                            <i class="bi bi-pencil me-1"></i> Edit Department
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal for each department -->
                        <div class="modal fade" id="deleteDepartmentModal{{ $department->Dept_ID }}" tabindex="-1" aria-labelledby="deleteDepartmentModalLabel{{ $department->Dept_ID }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center p-5">
                                        <div class="delete-modal-icon text-warning">
                                            <i class="bi bi-exclamation-triangle display-4"></i>
                                        </div>
                                        <h4 class="delete-modal-title mt-3">Delete Department</h4>

                                        @if($department->majors_count > 0)
                                            <div class="alert alert-warning mt-3">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                This department has {{ $department->majors_count }} major(s) associated with it.
                                            </div>
                                            <p class="delete-modal-text text-muted">
                                                You cannot delete <strong>{{ $department->Dept_Name }}</strong> because it contains majors.
                                                Please reassign or delete the majors first before deleting this department.
                                            </p>
                                            <div class="d-flex justify-content-center gap-3 mt-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#viewDepartmentModal{{ $department->Dept_ID }}">
                                                    View Majors
                                                </button>
                                            </div>
                                        @else
                                            <p class="delete-modal-text text-muted">
                                                Are you sure you want to delete <strong>{{ $department->Dept_Name }}</strong>?
                                                This action cannot be undone.
                                            </p>
                                            <form action="{{ route('admin.departments.destroy', $department->Dept_ID) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-3 mt-4">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete Department</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-building-x display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No departments found</h5>
                                    <p class="text-muted mb-4">Get started by adding your first department.</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                                        <i class="bi bi-building-add"></i> Add New Department
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($departments->hasPages())
                <div class="pagination-container mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info text-muted">
                            Showing {{ $departments->firstItem() }} to {{ $departments->lastItem() }} of {{ $departments->total() }} departments
                        </div>
                        <nav>
                            {{ $departments->withQueryString()->links('vendor.pagination.bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">
                        <i class="bi bi-building-add me-2"></i>
                        Add New Department
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.departments.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Dept_Name" class="form-label">Department Name *</label>
                            <input type="text" class="form-control" id="Dept_Name" name="Dept_Name"
                                   placeholder="e.g., Computer Science, Mathematics, Physics" required>
                            <div class="form-text">Enter the full name of the department.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .department-row:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .department-id {
            background-color: #e9ecef;
            color: #495057;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .department-info .department-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .majors-count {
            font-size: 0.9rem;
            padding: 8px 12px;
        }

        .associated-majors {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            align-items: center;
        }

        .major-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .more-majors {
            color: #6c757d;
            font-size: 0.75rem;
            font-style: italic;
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

        .department-info-card {
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

        .majors-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .major-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .major-item:last-child {
            border-bottom: none;
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

            .associated-majors {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush
