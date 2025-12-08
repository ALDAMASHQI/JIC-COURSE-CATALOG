@extends('layouts.app')

@section('content')
    <!-- Course Detail Header -->
    <header class="detail-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-white opacity-75">Courses</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $course->Course_Title }}</li>
                </ol>
            </nav>
            <h1>{{ $course->Course_Title }}</h1>
            <p class="lead opacity-90 mt-3">{{ $course->Course_Description }}</p>
            <div class="course-badges mt-3">
                <span class="badge bg-light text-dark me-2">
                    <i class="bi bi-clock me-1"></i>{{ $course->Credit_Hours }} Credits
                </span>
                <span class="badge bg-light text-dark me-2">
                    <i class="bi bi-journals me-1"></i>{{ $course->Course_Code }}
                </span>
                @foreach($course->majors as $major)
                    <span class="badge bg-primary me-2">{{ $major->Major_Name }}</span>
                @endforeach
            </div>
        </div>
    </header>

    <!-- Main Course Content -->
    <section class="course-detail-section pt-0">
        <div class="container">
            <div class="row">
                <!-- Course Overview & Rating (Left Column) -->
                <div class="col-lg-8">
                    <!-- Course Overview Card -->
                    <div class="detail-card p-4 p-md-5 mb-4">
                        <h3 class="mb-4" style="color: var(--dark-gray); font-weight: 700;">Course Details</h3>

                        <div class="mb-4">
                            <h5 style="color: var(--accent-gold); font-weight: 600;">Course Description</h5>
                            <p class="fs-5">{{ $course->Course_Description }}</p>
                        </div>

                        <hr class="my-4">

                        <!-- Prerequisites -->
                        @if($course->prerequisites->count() > 0)
                            <div class="mb-4">
                                <h5 style="color: var(--accent-gold); font-weight: 600;">Prerequisites</h5>
                                <ul class="list-unstyled">
                                    @foreach($course->prerequisites as $prereq)
                                        <li><i class="bi bi-arrow-right me-2 text-primary"></i>
                                            <a href="{{ route('courses.show', $prereq->prerequisite->Course_ID) }}" class="text-decoration-none">
                                                {{ $prereq->prerequisite->Course_Code }} - {{ $prereq->prerequisite->Course_Title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Associated Majors -->
                        @if($course->majors->count() > 0)
                            <div class="mb-4">
                                <h5 style="color: var(--accent-gold); font-weight: 600;">Available in Majors</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($course->majors as $major)
                                        <span class="badge bg-info text-dark">{{ $major->Major_Name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="alert alert-info mt-4" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            Course Code: <span class="fw-bold">{{ $course->Course_Code }}</span> |
                            Credit Hours: <span class="fw-bold">{{ $course->Credit_Hours }}</span>
                        </div>
                    </div>

                    <!-- Rating Summary and Reviews Section -->
                    <div  class="detail-card p-4 p-md-5 mb-4">
                        <h3 class="mb-4" style="color: var(--primary-dark); font-weight: 700;">Student Ratings & Reviews</h3>

                        @if($totalRatings > 0)
                            <div class="row align-items-center mb-4">
                                <div class="col-md-4 text-center">
                                    <div class="rating-display" style="font-size: 3.5rem; line-height: 1;">
                                        {{ number_format($course->student_ratings_avg_average_difficulty_rate, 1) }}
                                    </div>
                                    <div class="rating-stars mb-2" style="font-size: 1.5rem;">
                                        @php
                                            $avgRating = $course->student_ratings_avg_average_difficulty_rate;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                        @endphp
                                        @for($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor
                                        @if($hasHalfStar)
                                            <i class="bi bi-star-half text-warning"></i>
                                        @endif
                                        @for($i = 0; $i < (5 - $fullStars - ($hasHalfStar ? 1 : 0)); $i++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-0 fw-bold">(Based on {{ $totalRatings }} ratings)</p>
                                </div>
                                <div class="col-md-8">
                                    <!-- Rating bars -->
                                    @for($stars = 5; $stars >= 1; $stars--)
                                        <div class="mb-2 d-flex align-items-center">
                                            <span class="me-2" style="width: 60px;">{{ $stars }} Stars</span>
                                            <div class="progress flex-grow-1" style="height: 10px; border-radius: 5px;">
                                                <div class="progress-bar
                                                @if($stars >= 4) bg-success
                                                @elseif($stars >= 3) bg-info
                                                @elseif($stars >= 2) bg-warning
                                                @else bg-danger
                                                @endif"
                                                     role="progressbar"
                                                     style="width: {{ $ratingPercentages[$stars] }}%;"
                                                     aria-valuenow="{{ $ratingPercentages[$stars] }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span class="ms-2 text-muted fw-bold" style="width: 50px; text-align: right;">
                                            {{ number_format($ratingPercentages[$stars], 1) }}%
                                        </span>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <h5 class="mt-5 mb-3" style="color: var(--primary-dark); border-bottom: 2px solid var(--light-gray); padding-bottom: 5px;">
                                Recent Student Reviews:
                            </h5>

                            <!-- Student Reviews -->
                            @forelse($course->studentRatings->take(5) as $rating)
                                <div class="p-3 border rounded-3 mb-3 bg-light">
                                    <div class="rating-stars text-warning mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= round($rating->Average_difficulty_rate) ? '-fill' : '' }}"></i>
                                        @endfor
                                        <span class="ms-2 fw-bold">{{ number_format($rating->Average_difficulty_rate, 1) }}/5</span>
                                    </div>
                                    @if($rating->Rating_Comment)
                                        <p class="mb-1 fst-italic">"{{ $rating->Rating_Comment }}"</p>
                                    @else
                                        <p class="mb-1 fst-italic text-muted">No comment provided.</p>
                                    @endif
                                    <small class="text-muted d-block">
                                        - {{ $rating->student->Student_Name ?? 'Anonymous' }} |
                                        {{ $rating->created_at ? $rating->created_at->format('M d, Y') : 'Unknown date' }}
                                    </small>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No reviews yet. Be the first to rate this course!
                                </div>
                            @endforelse

                        @else
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle me-2"></i>
                                No ratings yet for this course. Be the first to rate!
                            </div>
                        @endif
                    </div>

                    <!-- Add New Rating Section -->
                    @auth
                        <div class="detail-card p-4 p-md-5">
                            <h3 class="mb-4" style="color: var(--primary-dark); font-weight: 700;">
                                <i class="bi bi-pencil me-2"></i> Rate This Course
                            </h3>
                            <form action="{{ route('courses.rate', $course->Course_ID) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Difficulty Rating:</label>
                                    <div class="rating-input">
                                        <div class="d-flex align-items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="difficulty_rating"
                                                           id="rating{{ $i }}" value="{{ $i }}"
                                                        {{ $i == 3 ? 'checked' : '' }}>
                                                    <label class="form-check-label rating-star-label" for="rating{{ $i }}">
                                                        @for($j = 1; $j <= $i; $j++)
                                                            <i class="bi bi-star{{ $j <= $i ? '-fill' : '' }} text-warning"></i>
                                                        @endfor
                                                        <span class="ms-1">({{ $i }})</span>
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                        <small class="text-muted">1 = Very Easy, 5 = Very Difficult</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="rating_comment" class="form-label fw-bold">Your Review (Optional):</label>
                                    <textarea class="form-control" id="rating_comment" name="rating_comment"
                                              rows="4" placeholder="Share your experience with this course..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Submit Rating</button>
                            </form>
                        </div>
                    @else
                        <div class="detail-card p-4 p-md-5 text-center">
                            <h4 class="mb-3">Want to rate this course?</h4>
                            <p class="text-muted mb-4">Please login to share your experience and help other students.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Sign Up</a>
                        </div>
                    @endauth
                </div>

                <!-- Course Metadata (Right Column/Sidebar) -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div style="    background-color: #f5f5f5;" class="detail-card sticky-sidebar">
                        <div class="text-center mb-3">
                            <div class="rating-stars" style="font-size: 1.8rem;">
                                @php
                                    $avgRating = $course->student_ratings_avg_average_difficulty_rate ?? 0;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= floor($avgRating) ? '-fill' : ($i == ceil($avgRating) && ($avgRating - floor($avgRating)) >= 0.5 ? '-half' : '') }} text-warning"></i>
                                @endfor
                            </div>
                            <span class="fs-5 fw-bold" style="color: var(--accent-gold);">
                                {{ $avgRating ? number_format($avgRating, 1) : 'No ratings' }}
                            </span>
                            <p class="text-muted mb-0">
                                <small>{{ $totalRatings }} Student Ratings</small>
                            </p>
                        </div>

                        <!-- Course Metadata -->
                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-clock me-2"></i> <span class="detail-label">Credit Hours</span></div>
                            <span class="detail-value">{{ $course->Credit_Hours }}</span>
                        </div>

                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-journals me-2"></i> <span class="detail-label">Course Code</span></div>
                            <span class="detail-value">{{ $course->Course_Code }}</span>
                        </div>

                        @if($course->majors->first())
                            <div class="detail-meta-item d-flex justify-content-between align-items-center">
                                <div><i class="bi bi-building me-2"></i> <span class="detail-label">Dept</span></div>
                                <span class="detail-value">{{ $course->majors->first()->department->Dept_Name ?? 'N/A' }}</span>
                            </div>
                        @endif

                        <div class="detail-meta-item d-flex justify-content-between align-items-center">
                            <div><i class="bi bi-bar-chart me-2"></i> <span class="detail-label">Difficulty</span></div>
                            <span class="detail-value
                                @if($avgRating >= 4) text-danger
                                @elseif($avgRating >= 3) text-warning
                                @elseif($avgRating > 0) text-info
                                @else text-muted
                                @endif">
                                @if($avgRating > 0)
                                    {{ number_format($avgRating, 1) }}/5
                                @else
                                    Not rated
                                @endif
                            </span>
                        </div>

                        <!-- Related Courses -->
                        @if($relatedCourses->count() > 0)
                            <div class="mt-4">
                                <h6 class="mb-3" style="color: var(--dark-gray);">Related Courses</h6>
                                @foreach($relatedCourses as $relatedCourse)
                                    <div class="related-course-item mb-2 p-2 border rounded">
                                        <a href="{{ route('courses.show', $relatedCourse->Course_ID) }}"
                                           class="text-decoration-none">
                                            <div class="fw-bold small">{{ $relatedCourse->Course_Code }}</div>
                                            <div class="text-muted small">{{ Str::limit($relatedCourse->Course_Title, 40) }}</div>
                                            <div class="small">
                                            <span class="text-warning">
                                                {{ number_format($relatedCourse->student_ratings_avg_average_difficulty_rate ?? 0, 1) }}/5
                                            </span>
                                                <span class="text-muted ms-2">
                                                ({{ $relatedCourse->student_ratings_count }} ratings)
                                            </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>

        .navbar-brand span {
            color: var(--primary-dark);
            font-weight: 700;
        }

        /* Detail-specific styles */
        .course-detail-section {
            padding: 80px 0;
        }

        .detail-header {
            background-color: var(--accent-gold);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }

        .detail-header h1 {
            font-weight: 800;
            font-size: 2.8rem;
        }

        .detail-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow-card);
        }

        .detail-meta-item {
            padding: 20px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .detail-meta-item:last-child {
            border-bottom: none;
        }

        .detail-meta-item i {
            color: var(--primary-dark);
            font-size: 1.2rem;
            width: 30px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark-gray);
        }

        .detail-value {
            font-weight: 700;
            color: var(--accent-gold);
        }

        .rating-display {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 15px;
        }

        .rating-stars {
            color: #ffc107; /* Bootstrap warning color for stars */
        }

        .progress {
            background-color: var(--light-gray);
        }

        /* Sticky sidebar for friendly design */
        @media (min-width: 992px) {
            .sticky-sidebar {
                position: sticky;
                top: 100px; /* Offset for the navigation bar height */
            }
        }

        /* Review form styling */
        .rating-input .form-check-label {
            cursor: pointer;
            transition: color 0.2s;
            font-size: 1.5rem;
        }
        .rating-input .form-check-input:checked ~ .form-check-label i {
            color: #ffc107;
        }


    </style>
@endpush

@push('js')
    <script>
        // Rating stars interaction
        document.querySelectorAll('.rating-star-label').forEach(label => {
            label.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });

        // Update star display on hover
        document.querySelectorAll('input[name="difficulty_rating"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // You can add visual feedback here if needed
                console.log('Selected rating:', this.value);
            });
        });
    </script>
@endpush
