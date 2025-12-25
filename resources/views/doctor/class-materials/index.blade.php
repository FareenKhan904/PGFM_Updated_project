@extends('layouts.doctor')

@section('title', 'Class Materials - Doctor Dashboard')

@section('page-title', 'Class Materials: ' . $class->title)

@section('doctor-content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #2563eb;">
                <i class="fas fa-file-alt me-2"></i>Materials for: {{ $class->title }}
            </h3>
            @if($class->course)
            <p class="text-muted mb-0">
                <i class="fas fa-graduation-cap me-1"></i>Course: {{ $class->course->title }}
            </p>
            @endif
        </div>
        <div>
            <a href="{{ route('doctor.classes.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Back to Classes
            </a>
            <a href="{{ route('doctor.class-materials.create', $class) }}" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">
                <i class="fas fa-plus me-2"></i>Add Material
            </a>
        </div>
    </div>
</div>

@if($materials->count() > 0)
<div class="row g-4">
    @foreach($materials as $material)
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; border-left: 4px solid @if($material->type == 'pdf') #ef4444 @elseif($material->type == 'video') #f59e0b @elseif($material->type == 'link') #10b981 @else #2563eb @endif;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="mb-1 fw-bold" style="color: #2563eb;">{{ $material->title }}</h5>
                        <span class="badge rounded-pill @if($material->type == 'pdf') bg-danger @elseif($material->type == 'video') bg-warning @elseif($material->type == 'link') bg-success @else bg-primary @endif">
                            @if($material->type == 'pdf')
                                <i class="fas fa-file-pdf me-1"></i>PDF
                            @elseif($material->type == 'video')
                                <i class="fas fa-video me-1"></i>Video
                            @elseif($material->type == 'link')
                                <i class="fas fa-link me-1"></i>Link
                            @elseif($material->type == 'document')
                                <i class="fas fa-file-word me-1"></i>Document
                            @else
                                <i class="fas fa-file me-1"></i>Other
                            @endif
                        </span>
                    </div>
                    <span class="badge rounded-pill {{ $material->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $material->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                @if($material->description)
                <p class="text-muted small mb-3">{{ Str::limit($material->description, 100) }}</p>
                @endif
                
                <div class="mb-3">
                    @if($material->file_path)
                    <p class="small mb-1">
                        <i class="fas fa-file me-1" style="color: #2563eb;"></i>
                        <strong>File:</strong> {{ $material->file_name }}
                    </p>
                    @if($material->file_size)
                    <p class="small mb-0 text-muted">
                        Size: {{ number_format($material->file_size / 1024, 2) }} KB
                    </p>
                    @endif
                    @elseif($material->external_link)
                    <p class="small mb-0">
                        <i class="fas fa-external-link-alt me-1" style="color: #10b981;"></i>
                        <a href="{{ $material->external_link }}" target="_blank" class="text-decoration-none">View Link</a>
                    </p>
                    @endif
                </div>
                
                <div class="d-grid gap-2 mt-3">
                    @if($material->file_path)
                    @php
                        $fileExtension = strtolower(pathinfo($material->file_name, PATHINFO_EXTENSION));
                        $canView = in_array($fileExtension, ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif']);
                    @endphp
                    @if($canView)
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#viewMaterialModal{{ $material->id }}">
                        <i class="fas fa-eye me-1"></i>View
                    </button>
                    @endif
                    <a href="{{ $material->file_url }}" target="_blank" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-download me-1"></i>Download
                    </a>
                    @elseif($material->external_link)
                    <a href="{{ $material->external_link }}" target="_blank" class="btn btn-outline-success btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-external-link-alt me-1"></i>Open Link
                    </a>
                    @endif
                    <a href="{{ route('doctor.class-materials.edit', [$class, $material]) }}" class="btn btn-outline-warning btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('doctor.class-materials.destroy', [$class, $material]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this material?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100" style="border-radius: 8px;">
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
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body text-center p-5">
        <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">No Materials Added</h5>
        <p class="text-muted mb-4">You haven't added any materials to this class yet. Add PDFs, videos, or links to help your students learn.</p>
        <a href="{{ route('doctor.class-materials.create', $class) }}" class="btn text-white" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); border: none; border-radius: 8px;">
            <i class="fas fa-plus me-2"></i>Add First Material
        </a>
    </div>
</div>
@endif

<!-- View Material Modals -->
@foreach($materials as $material)
@if($material->file_path)
@php
    $fileExtension = strtolower(pathinfo($material->file_name, PATHINFO_EXTENSION));
    $canView = in_array($fileExtension, ['pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif']);
@endphp
@if($canView)
@php
    $fileUrl = asset('storage/' . $material->file_path);
@endphp
<div class="modal fade" id="viewMaterialModal{{ $material->id }}" tabindex="-1" aria-labelledby="viewMaterialModalLabel{{ $material->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title fw-bold" id="viewMaterialModalLabel{{ $material->id }}">
                    <i class="fas fa-file-alt me-2"></i>{{ $material->title }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" style="min-height: 500px;">
                @if($fileExtension == 'pdf')
                    <iframe src="{{ $fileUrl }}#toolbar=0" style="width: 100%; height: 80vh; border: none;" frameborder="0" type="application/pdf"></iframe>
                @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                    <div class="text-center p-4">
                        <img src="{{ $fileUrl }}" alt="{{ $material->title }}" style="max-width: 100%; max-height: 80vh; border-radius: 10px;">
                    </div>
                @elseif(in_array($fileExtension, ['doc', 'docx']))
                    <div class="p-4">
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>Word documents can be viewed using Google Docs Viewer.
                        </div>
                        <iframe src="https://docs.google.com/gview?url={{ urlencode($fileUrl) }}&embedded=true" style="width: 100%; height: 80vh; border: none;" frameborder="0"></iframe>
                    </div>
                @elseif($fileExtension == 'txt')
                    <div class="p-4">
                        <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: monospace; background: #f8f9fa; padding: 1rem; border-radius: 8px; max-height: 80vh; overflow-y: auto;">Loading...</pre>
                        <script>
                            fetch('{{ $fileUrl }}')
                                .then(response => response.text())
                                .then(text => {
                                    document.querySelector('#viewMaterialModal{{ $material->id }} pre').textContent = text;
                                })
                                .catch(error => {
                                    document.querySelector('#viewMaterialModal{{ $material->id }} pre').textContent = 'Error loading file. Please download to view.';
                                });
                        </script>
                    </div>
                @endif
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                <a href="{{ $material->file_url }}" target="_blank" class="btn btn-outline-primary" style="border-radius: 8px;">
                    <i class="fas fa-download me-1"></i>Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endforeach
@endsection
