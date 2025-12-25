@extends('layouts.doctor')

@section('title', 'News - Doctor Dashboard')

@section('doctor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-newspaper me-2 text-primary"></i>News</h2>
    <a href="{{ route('doctor.news.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New News
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($news->count() > 0)
<div class="row g-4">
    @foreach($news as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title mb-0">{{ $item->title }}</h5>
                    <div class="d-flex flex-column gap-1">
                        <span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $item->is_published ? 'Published' : 'Draft' }}
                        </span>
                        <span class="badge {{ $item->type == 0 ? 'bg-primary' : 'bg-info' }}">
                            {{ $item->type == 0 ? 'Classes News' : 'Reference News' }}
                        </span>
                    </div>
                </div>
                <p class="card-text text-muted">{{ Str::limit($item->content, 100) }}</p>
                <small class="text-muted d-block mb-3">
                    <i class="fas fa-calendar me-1"></i>{{ $item->created_at->format('M d, Y') }}
                </small>
                <div class="btn-group btn-group-sm w-100">
                    <a href="{{ route('doctor.news.edit', $item) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('doctor.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this news item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($news->hasPages())
<div class="mt-4">
    {{ $news->links() }}
</div>
@endif
@else
<div class="card border-0 shadow-sm">
    <div class="card-body p-5 text-center">
        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">No news items yet</h5>
        <p class="text-muted">Start by adding your first news item.</p>
        <a href="{{ route('doctor.news.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus me-2"></i>Add New News
        </a>
    </div>
</div>
@endif
@endsection

