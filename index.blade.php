@extends('layouts.app')

@section('content')
    <!-- Course Listing Header -->
    <header class="course-listing-header">
        <div class="container text-center">
            <h1>Explore Our Course Catalog</h1>
            <p class="lead opacity-75">Discover {{ $totalCourses }}+ professional and academic courses to advance your career at Jubail Industrial College.</p>
        </div>
    </header>

    <!-- Main Course Content -->
    <section class="course-listing-content bg-light">
        <div class="container">
            <div class="row">
                <!-- Filter Sidebar (lg: 3 columns) -->
                <div class="col-lg-3">
                    <form id="filter-form" method="GET" action="{{ route('courses.index') }}">
                        <div class="filter-sidebar">
                            <h4 class="mb-4 text-center text-lg-start" style="color: var(--dark-gray); font-weight: 800;">Filters</h4>

                            <!-- Search Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-search me-2 text-muted"></i> Search Course</h6>
                                <input type="text"
                                       class="form-control"
                                       name="search"
                                       id="course-search-input"
                                       placeholder="Keyword or code"
                                       value="{{ request('search') }}">
                            </div>

                            <!-- Category Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-layer-group me-2 text-muted"></i> Department</h6>
                                <select class="form-select" name="category" id="course-category">
                                    <option value="">All Departments</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->Dept_Name }}"
                                            {{ request('category') == $department->Dept_Name ? 'selected' : '' }}>
                                            {{ $department->Dept_Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Difficulty Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-bar-chart me-2 text-muted"></i> Difficulty Level</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="beginner" id="diffBeginner"
                                        {{ request('difficulty') == 'beginner' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diffBeginner">Beginner (≤ 2.5)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="intermediate" id="diffIntermediate"
                                        {{ request('difficulty') == 'intermediate' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diffIntermediate">Intermediate (2.6-3.5)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="advanced" id="diffAdvanced"
                                        {{ request('difficulty') == 'advanced' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diffAdvanced">Advanced (≥ 3.6)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="difficulty" value="" id="diffAll"
                                        {{ !request('difficulty') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diffAll">All Levels</label>
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="filter-group">
                                <h6><i class="bi bi-star me-2 text-muted"></i> Minimum Rating</h6>
                                <div class="star-filter d-flex gap-3" id="star-filter">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star rating-star fs-4"
                                           data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="min_rating" id="min_rating"
                                       value="{{ request('min_rating') }}">
                            </div>


                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-accent mt-3">Apply Filters</button>
                                <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Clear Filters</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Course Results (lg: 9 columns) -->
                <div class="col-lg-9">
                    <!-- Results Summary -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="results-summary mb-0">
                            Showing <span id="course-count">{{ $courses->count() }}</span> of {{ $courses->total() }} total courses.
                        </p>
                        <form id="sort-form" method="GET" class="d-inline">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('difficulty'))
                                <input type="hidden" name="difficulty" value="{{ request('difficulty') }}">
                            @endif
                            @if(request('min_rating'))
                                <input type="hidden" name="min_rating" value="{{ request('min_rating') }}">
                            @endif
                            <select class="form-select w-auto" name="sort" id="sort-by-select" onchange="this.form.submit()">
                                <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Sort by Relevance</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Top Rated</option>
                                <option value="duration" {{ request('sort') == 'duration' ? 'selected' : '' }}>Duration (Shortest)</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            </select>
                        </form>
                    </div>

                    <!-- Course Grid Container -->
                    <div class="row" id="course-results-container">
                        @forelse($courses as $course)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card course-card h-100">
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
                                            <span class="ms-1">
                                                {{ $avgRating ? number_format($avgRating, 1) : 'No ratings' }}/5
                                            </span>
{{--                                            <span class="course-code">{{ $course->Course_Code }}</span>--}}
                                        </div>
                                    </div>
                                    <div class="course-card-body">
                                        <p class="card-text">
                                            {{ Str::limit($course->Course_Description, 50) }}
                                        </p>
                                        <div class="course-meta">
                                            <span class="course-badge">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $course->Credit_Hours }} Credits
                                            </span>
                                            <span class="text-muted">
                                                <i class="bi bi-bar-chart-fill me-1"></i>
                                                Difficulty:
                                                <strong class="@if($avgRating >= 4) text-danger @elseif($avgRating >= 3) text-warning @elseif($avgRating > 0) text-info @else text-muted @endif">
                                                    {{ $avgRating ? number_format($avgRating, 1) : 'N/A' }}/5
                                                </strong>
                                            </span>
                                        </div>
                                        @if($course->student_ratings_count > 0)
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    <i class="bi bi-people me-1"></i>
                                                    {{ $course->student_ratings_count }} ratings
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="course-card-footer">
                                        <a href="{{ route('courses.show', $course->Course_ID) }}" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No courses found matching your criteria. Try adjusting your filters.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($courses->hasPages())
                        <div class="d-flex justify-content-center mt-5">
                            <nav aria-label="Course pagination">
                                <ul class="pagination shadow-sm rounded-pill">
                                    {{-- Previous Page Link --}}
                                    @if($courses->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if($courses->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        // Update rating value display
        document.getElementById('rating-range').addEventListener('input', function() {
            document.getElementById('rating-value').textContent = this.value + '+';
        });

        // Auto-submit form when filters change (optional)
        document.querySelectorAll('#filter-form input, #filter-form select').forEach(element => {
            element.addEventListener('change', function() {
                // For better UX, you might want to debounce this or use a submit button
                // document.getElementById('filter-form').submit();
            });
        });

        // Course search with debounce
        let searchTimeout;
        document.getElementById('course-search-input').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filter-form').submit();
            }, 500);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".rating-star");
            const input = document.getElementById("min_rating");
            const selected = parseFloat(input.value) || 0; // default no selection

            function highlightStars(value) {
                stars.forEach(star => {
                    const starValue = parseInt(star.dataset.value);
                    if (value >= starValue) {
                        star.classList.remove("bi-star");
                        star.classList.add("bi-star-fill", "text-warning");
                    } else {
                        star.classList.add("bi-star");
                        star.classList.remove("bi-star-fill", "text-warning");
                    }
                });
            }

            // Restore previous selection if exists
            if (selected > 0) {
                highlightStars(selected);
            }

            stars.forEach(star => {
                star.addEventListener("click", function () {
                    const value = parseFloat(this.dataset.value);

                    // Toggle: if user clicks same value → reset to none
                    if (input.value == value) {
                        input.value = "";
                        highlightStars(0);
                        return;
                    }

                    input.value = value;
                    highlightStars(value);
                });
            });
        });
    </script>

@endpush
