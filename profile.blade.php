@extends('layouts.app')

@section('content')

    <!-- Content Area -->
    <div class="container-fluid py-5">
        <div class="row">
            <!-- Left Column - Profile Summary -->
            <div class="col-lg-4">
                <!-- Profile Summary Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-3">
                            <div class="avatar-circle">
                                {{ strtoupper(substr(auth()->user()->Username, 0, 2)) }}
                            </div>
                        </div>
                        <h5 class="card-title">{{ $student->Student_Name }}</h5>
                        <p class="card-text text-muted mb-2">Student</p>
                        <p class="card-text small text-muted">
                            <i class="bi bi-envelope me-1"></i>
                            {{ $student->Student_Email }}
                        </p>
                        @if($student->major)
                            <p class="card-text small text-muted">
                                <i class="bi bi-journal-text me-1"></i>
                                {{ $student->major->Major_Name }}
                            </p>
                        @endif
                        <div class="profile-stats mt-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="stat-item">
                                        <div class="stat-value text-primary">{{ $ratings->total() }}</div>
                                        <div class="stat-label">Course Ratings</div>
                                    </div>
                                </div>
                                <div class="col-6">
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-lightning me-2"></i>
                            Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-search me-2"></i>
                                Browse Courses
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Tabs Content -->
            <div class="col-lg-8">
                <!-- Tabs Navigation -->
                <div class="card mb-4">
                    <div class="card-header bg-white border-bottom-0 p-0">
                        <ul class="nav nav-tabs profile-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="true">
                                    <i class="bi bi-person-gear me-2"></i>
                                    Profile Settings
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ratings-tab" data-bs-toggle="tab"
                                        data-bs-target="#ratings" type="button" role="tab" aria-controls="ratings"
                                        aria-selected="false">
                                    <i class="bi bi-star me-2"></i>
                                    My Ratings
                                    <span class="badge bg-primary ms-1">{{ $ratings->total() }}</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab Content -->
                        <div class="tab-content" id="profileTabsContent">

                            <!-- Profile Settings Tab -->
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Please fix the following errors:
                                        <ul class="mb-0 mt-1">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <form action="{{ route('student.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Student Information Section -->
                                    <div class="section-header mb-4">
                                        <h6 class="section-title">
                                            <i class="bi bi-person-badge me-2"></i>
                                            Student Information
                                        </h6>
                                        <div class="section-divider"></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="Student_Name" class="form-label">Full Name *</label>
                                            <input type="text" class="form-control @error('Student_Name') is-invalid @enderror"
                                                   id="Student_Name" name="Student_Name"
                                                   value="{{ old('Student_Name', $student->Student_Name) }}" required
                                                   placeholder="Enter your full name">
                                            @error('Student_Name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Student_Email" class="form-label">Student Email *</label>
                                            <input type="email" class="form-control @error('Student_Email') is-invalid @enderror"
                                                   id="Student_Email" name="Student_Email"
                                                   value="{{ old('Student_Email', $student->Student_Email) }}" required
                                                   placeholder="Enter your student email">
                                            @error('Student_Email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Account Information Section -->
                                    <div class="section-header mb-4 mt-4">
                                        <h6 class="section-title">
                                            <i class="bi bi-person-circle me-2"></i>
                                            Account Information
                                        </h6>
                                        <div class="section-divider"></div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="Username" class="form-label">Username *</label>
                                            <input type="text" class="form-control @error('Username') is-invalid @enderror"
                                                   id="Username" name="Username"
                                                   value="{{ old('Username', auth()->user()->Username) }}" required
                                                   placeholder="Enter your username">
                                            @error('Username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Email" class="form-label">Login Email *</label>
                                            <input type="email" class="form-control @error('Email') is-invalid @enderror"
                                                   id="Email" name="Email"
                                                   value="{{ old('Email', auth()->user()->Email) }}" required
                                                   placeholder="Enter your login email">
                                            @error('Email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Change Section -->
                                    <div class="section-header mb-4 mt-4">
                                        <h6 class="section-title">
                                            <i class="bi bi-shield-lock me-2"></i>
                                            Password Change
                                        </h6>
                                        <div class="section-divider"></div>
                                        <small class="text-muted">Leave blank to keep current password</small>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                   id="current_password" name="current_password"
                                                   placeholder="Enter current password">
                                            @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password"
                                                   placeholder="Enter new password">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Minimum 8 characters</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control"
                                                   id="password_confirmation" name="password_confirmation"
                                                   placeholder="Confirm new password">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- My Ratings Tab -->
                            <div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
                                @if($ratings->count() > 0)
                                    <!-- Ratings Summary -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-info-circle me-3 display-6"></i>
                                                    <div>
                                                        <h6 class="alert-heading mb-1">Your Course Ratings</h6>
                                                        <p class="mb-0">You have rated {{ $ratings->total() }} course(s). You can delete any rating by clicking the trash icon.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ratings List -->
                                    <div class="ratings-grid">
                                        @foreach($ratings as $rating)
                                            <div class="rating-card mb-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-8">
                                                                <div class="d-flex align-items-start mb-2">
                                                                    <div class="course-icon bg-primary text-white rounded p-2 me-3">
                                                                        <i class="bi bi-journal-text"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1">{{ $rating->course->Course_Code }}</h6>
                                                                        <p class="mb-1 text-muted small">{{ $rating->course->Course_Title }}</p>
                                                                        <div class="rating-stars mb-2">
                                                                            @for($i = 1; $i <= 5; $i++)
                                                                                <i class="bi bi-star{{ $i <= $rating->Average_difficulty_rate ? '-fill' : '' }} text-warning"></i>
                                                                            @endfor
                                                                            <span class="ms-2 small text-muted">{{ number_format($rating->Average_difficulty_rate, 1) }}/5</span>
                                                                        </div>
                                                                        @if($rating->Rating_Comment)
                                                                            <p class="mb-0 fst-italic small text-muted">
                                                                                "{{ $rating->Rating_Comment }}"
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 text-md-end">
                                                                <div class="text-muted small mb-2">
                                                                    {{ $rating->created_at->format('M d, Y \\a\\t h:i A') }}
                                                                </div>
                                                                <button class="btn btn-sm btn-outline-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRatingModal{{ $rating->Course_ID }}">
                                                                    <i class="bi bi-trash me-1"></i> Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Rating Modal -->
                                            <div class="modal fade" id="deleteRatingModal{{ $rating->Course_ID }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-4">
                                                            <div class="text-warning mb-3">
                                                                <i class="bi bi-exclamation-triangle display-4"></i>
                                                            </div>
                                                            <h5 class="modal-title mb-3">Delete Rating</h5>
                                                            <p class="text-muted mb-4">
                                                                Are you sure you want to delete your rating for
                                                                <strong>{{ $rating->course->Course_Code }}</strong>?
                                                            </p>
                                                            <form action="{{ route('student.rating.delete', $rating->Course_ID) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="d-flex justify-content-center gap-3">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Delete Rating</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination -->
                                    @if($ratings->hasPages())
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $ratings->links('vendor.pagination.bootstrap-5') }}
                                        </div>
                                    @endif
                                @else
                                    <!-- Empty State -->
                                    <div class="text-center py-5">
                                        <div class="empty-state-icon mb-4">
                                            <i class="bi bi-star display-1 text-muted"></i>
                                        </div>
                                        <h5 class="text-muted mb-3">No Ratings Yet</h5>
                                        <p class="text-muted mb-4">You haven't rated any courses yet. Start exploring courses and share your experience!</p>
                                        <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                            <i class="bi bi-search me-2"></i>Browse Courses
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .section-title:after {
            left: 52px !important;
        }
        /* Profile Tabs */
        .profile-tabs {
            border-bottom: 1px solid #dee2e6;
            padding: 0 1.25rem;
        }

        .profile-tabs .nav-link {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: #6c757d;
            background: transparent;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .profile-tabs .nav-link:hover {
            color: #495057;
            border-bottom-color: #dee2e6;
        }

        .profile-tabs .nav-link.active {
            color: #667eea;
            background: transparent;
            font-weight: 600;
        }

        .profile-tabs .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }

        /* Tab Content */
        .tab-content {
            padding: 0;
        }

        .tab-pane {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Section Styles */
        .section-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            text-align: left !important;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .section-divider {
            height: 2px;
            margin-top: 5px;
        }

        /* Avatar */
        .avatar-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #bc960b 0%, #bc960b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Profile Stats */
        .profile-stats .stat-item {
            padding: 10px 0;
        }

        .profile-stats .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .profile-stats .stat-label {
            color: #6c757d;
            font-size: 0.8rem;
        }

        /* Rating Cards */
        .rating-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .rating-card:hover {
            transform: translateY(-2px);
        }

        .rating-card .card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }

        .course-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rating-stars {
            font-size: 1rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }


        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* Empty State */
        .empty-state-icon {
            opacity: 0.7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }

            .avatar-circle {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
            }

            .rating-card .row > div {
                margin-bottom: 1rem;
            }

            .rating-card .text-md-end {
                text-align: left !important;
            }
        }

        @media (max-width: 576px) {
            .profile-tabs .nav-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.85rem;
            }

            .profile-tabs .nav-link i {
                margin-right: 0.25rem !important;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll to active tab on page load if hash exists
            if (window.location.hash) {
                const hash = window.location.hash.replace('#', '');
                const tab = document.querySelector(`[data-bs-target="#${hash}"]`);
                if (tab) {
                    new bootstrap.Tab(tab).show();
                }
            }

            // Update URL hash when tab changes
            const profileTabs = document.getElementById('profileTabs');
            profileTabs.addEventListener('shown.bs.tab', function (event) {
                const target = event.target.getAttribute('data-bs-target');
                history.pushState(null, null, target);
            });
        });
    </script>
@endpush
