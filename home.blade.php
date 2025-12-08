@extends('layouts.app')
@push('css')
    <style>
        .text-primary {
            --bs-text-opacity: 1;
            color: rgb(200 159 75) !important;
        }
    </style>
@endpush
@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <h1 class="hero-title">Plan Your Academic Journey with Confidence</h1>
                        <p class="hero-subtitle">Access comprehensive course information, difficulty ratings, and student feedback from Jubail Industrial College to make informed decisions about your education.</p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg"><i class="bi bi-search me-2"></i> Browse Courses</a>
                            <a href="{{ route('majors.index') }}" class="btn btn-outline-light btn-lg"><i class="bi bi-list-columns me-2"></i> Explore Majors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">How Our System Helps You Succeed</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-search-heart"></i>
                        </div>
                        <h4>Smart Course Search</h4>
                        <p>Find courses by name, code, department, or keywords with detailed information including prerequisites and learning outcomes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4>Difficulty Ratings</h4>
                        <p>See how other students rated course difficulty and workload to balance your semester schedule effectively.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center">
                        <div class="feature-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h4>Detailed Course Information</h4>
                        <p>Access comprehensive course details including descriptions, credit hours, assessment methods, and learning styles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="{{ $totalCourses }}">{{ $totalCourses }}+</div>
                        <div class="stat-label">Courses</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="{{ $totalMajors }}">{{ $totalMajors }}+</div>
                        <div class="stat-label">Majors</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="{{ $totalRatings }}">{{ number_format($totalRatings) }}+</div>
                        <div class="stat-label">Student Ratings</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-item">
                        <div class="stat-number" data-target="{{ $satisfactionRate }}">{{ $satisfactionRate }}%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Popular Courses & Student Favorites</h2>
            <div class="row g-4">
                @forelse($popularCourses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="card course-card">
                            <div class="course-card-header">
                                <h5 class="mb-2 text-white">{{ $course->Course_Title }}</h5>
                                <div class="course-rating">
                                    <span class="rating-stars">
                                        @php
                                            $avgRating = $course->student_ratings_avg_average_difficulty_rate ?? 0;
                                            $fullStars = floor($avgRating);
                                            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                        @endphp

                                        @for($i = 0; $i < $fullStars; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor

                                        @if($hasHalfStar)
                                            <i class="bi bi-star-half"></i>
                                        @endif

                                        @for($i = 0; $i < $emptyStars; $i++)
                                            <i class="bi bi-star"></i>
                                        @endfor
                                    </span>
                                    <span class="ms-1">{{ number_format($avgRating, 1) }}/5</span>
                                </div>
                            </div>
                            <div class="course-card-body">
                                <p class="card-text">{{ Str::limit($course->Course_Description, 50) }}</p>
                                <div class="course-meta">
                                    <span class="course-badge"><i class="bi bi-clock me-1"></i> {{ $course->Credit_Hours }} Credits</span>
                                    <span class="text-muted">
                                        <i class="bi bi-bar-chart-fill me-1"></i>
                                        Difficulty:
                                        <strong class="@if($avgRating >= 4) text-danger @elseif($avgRating >= 3) text-warning @else text-info @endif">
                                            {{ number_format($avgRating, 1) }}/5
                                        </strong>
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $course->total_ratings }} ratings
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            No courses with ratings available yet. Be the first to rate a course!
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('courses.index') }}" class="btn btn-accent btn-lg px-5 shadow-sm"><i class="bi bi-journals me-2"></i> Explore Full Catalog</a>
            </div>
        </div>
    </section>

    <section id="FeaturedMajors" class="py-5 bg-light">
        <div class="container">
            <h2  class="section-title">Featured Majors</h2>
            <div  class="row g-4">
                @forelse($featuredMajors as $major)
                    <div class="col-md-4">
                        <div class="card major-card text-center h-100">
                            <div class="major-card-header">
                                <div class="major-icon">
                                    <i class="bi bi-laptop"></i>
                                </div>
                                <h5>{{ $major->Major_Name }}</h5>
                                <span class="department-badge">{{ $major->department->Dept_Name ?? 'General' }}</span>
                            </div>
                            <div class="major-card-body">
                                <p class="card-text">{{ Str::limit($major->Major_Description ?? 'Comprehensive program offering in-depth knowledge and practical skills.', 100) }}</p>
                                <div class="major-meta">
                                    <span class="credits-badge">
                                        <i class="bi bi-award me-1"></i>
                                        {{ $major->Required_Credits }} Credits Required
                                    </span>
                                </div>
                            </div>
                            <div class="major-card-footer">
                                <a href="{{ route('courses.index') }}?Major_ID={{$major->Major_ID}}" class="btn btn-outline-primary btn-sm">Explore Courses</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            No majors available at the moment.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="Departments" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Departments</h2>

            <div class="row g-4">
                @foreach(\App\Models\Department::all() as $department)
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-diagram-3 fs-1 text-primary"></i>
                                </div>
                                <h5 class="card-title">{{ $department->Dept_Name }}</h5>

                                <p class="text-muted mb-2">
                                    {{ $department->majors->count() }} Majors
                                </p>

                                <a href="{{ route('courses.index', ['category' => $department->Dept_Name]) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    Explore Courses
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(\App\Models\Department::all()->isEmpty())
                <div class="alert alert-info text-center mt-4">
                    <i class="bi bi-info-circle"></i> No departments available yet.
                </div>
            @endif
        </div>
    </section>

@endsection
