@extends('layouts.doctor')

@section('title', 'Gallery - Website Management')

@section('doctor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-images me-2 text-primary"></i>Gallery Management</h2>
    <a href="{{ route('doctor.gallery.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Gallery Item
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($galleries->count() > 0)
    <div class="row g-4">
        @foreach($galleries as $gallery)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="position-relative">
                    @if($gallery->image_path)
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title ?? 'Gallery Image' }}" style="height: 250px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                    @endif
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="position-absolute top-0 start-0 m-2 badge bg-info">
                        Order: {{ $gallery->order ?? 0 }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $gallery->title ?? 'Untitled' }}</h5>
                    @if($gallery->description)
                    <p class="card-text text-muted small">{{ Str::limit($gallery->description, 100) }}</p>
                    @endif
                    
                    <div class="btn-group btn-group-sm w-100">
                        <a href="{{ route('doctor.gallery.edit', $gallery) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('doctor.gallery.destroy', $gallery) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this gallery item?');">
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
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5 text-center">
            <i class="fas fa-images fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No gallery items yet</h5>
            <p class="text-muted">Start by adding your first gallery item for the homepage.</p>
            <a href="{{ route('doctor.gallery.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Add New Gallery Item
            </a>
        </div>
    </div>
@endif
@endsection


