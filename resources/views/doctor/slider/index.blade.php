@extends('layouts.doctor')

@section('title', 'Slider Images - Website Management')

@section('doctor-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-images me-2 text-primary"></i>Slider Images Management</h2>
    <a href="{{ route('doctor.slider.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Slider Image
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@php
    $sliderImages = $sliderImages ?? collect();
@endphp

@if($sliderImages->count() > 0)
    <div class="row g-4">
        @foreach($sliderImages as $slider)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="position-relative">
                    @if($slider->image_path)
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="card-img-top" alt="{{ $slider->title ?? 'Slider Image' }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                    @endif
                    <span class="position-absolute top-0 end-0 m-2 badge {{ $slider->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $slider->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="position-absolute top-0 start-0 m-2 badge bg-info">
                        Order: {{ $slider->order ?? 0 }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $slider->title ?? 'Untitled' }}</h5>
                    @if($slider->description)
                    <p class="card-text text-muted small">{{ Str::limit($slider->description, 80) }}</p>
                    @endif
                    
                    @if($slider->button_text && $slider->button_link)
                    <p class="mb-2">
                        <small><i class="fas fa-link me-1"></i><strong>Button:</strong> {{ $slider->button_text }}</small><br>
                        <small class="text-muted">{{ $slider->button_link }}</small>
                    </p>
                    @endif
                    
                    <div class="btn-group btn-group-sm w-100">
                        <a href="{{ route('doctor.slider.edit', $slider) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('doctor.slider.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slider image?');">
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
            <h5 class="text-muted">No slider images yet</h5>
            <p class="text-muted">Start by adding your first slider image for the homepage.</p>
            <a href="{{ route('doctor.slider.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Add New Slider Image
            </a>
        </div>
    </div>
@endif
@endsection

