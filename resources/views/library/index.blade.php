@extends('layouts.public')

@section('title', 'Library - PGIFM')

@section('content')
<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Library</h1>
                <p class="lead">Access books, articles, documents, and other educational resources</p>
                <p class="small">Available exclusively for registered students</p>
            </div>
        </div>
    </div>
</section>

<!-- Library Section -->
<section class="py-5">
    <div class="container">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ route('library.index') }}" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by title, author, or description..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <select name="type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="book" {{ request('type') == 'book' ? 'selected' : '' }}>Books</option>
                                    <option value="article" {{ request('type') == 'article' ? 'selected' : '' }}>Articles</option>
                                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Documents</option>
                                    <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Videos</option>
                                    <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Library Items Grid -->
        @if($items->count() > 0)
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-primary">{{ ucfirst($item->type) }}</span>
                                    @if($item->file_path)
                                        <i class="fas fa-file text-muted"></i>
                                    @elseif($item->external_link)
                                        <i class="fas fa-external-link-alt text-muted"></i>
                                    @endif
                                </div>
                                
                                <h5 class="card-title mb-3">{{ $item->title }}</h5>
                                
                                @if($item->author)
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-user me-1"></i>{{ $item->author }}
                                    </p>
                                @endif
                                
                                @if($item->description)
                                    <p class="card-text small text-muted mb-3">
                                        {{ Str::limit($item->description, 100) }}
                                    </p>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($item->file_url)
                                        <a href="{{ $item->file_url }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download me-1"></i>View/Download
                                        </a>
                                    @else
                                        <span class="text-muted small">No file available</span>
                                    @endif
                                    
                                    @if($item->year)
                                        <span class="text-muted small">{{ $item->year }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $items->links() }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No library items found</h4>
                            <p class="text-muted">Try adjusting your search criteria.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

