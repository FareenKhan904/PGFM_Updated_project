@extends('layouts.student')

@section('title', 'Class Materials - Student Dashboard')

@section('page-title', 'Materials: ' . $class->title)

@section('student-content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #10b981;">
                <i class="fas fa-file-alt me-2"></i>{{ $class->title }}
            </h3>
            @if($class->course)
            <p class="text-muted mb-0">
                <i class="fas fa-graduation-cap me-1"></i>Course: {{ $class->course->title }}
            </p>
            @endif
        </div>
        <div>
            <a href="{{ route('student.classes.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Classes
            </a>
        </div>
    </div>
</div>

@if($class->description)
<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-3">
        <h6 class="fw-bold mb-2" style="color: #2563eb;">
            <i class="fas fa-info-circle me-2"></i>Class Description
        </h6>
        <p class="mb-0 text-muted">{{ $class->description }}</p>
    </div>
</div>
@endif

@if($class->scheduled_at || $class->duration || $class->meeting_link)
<div class="row g-3 mb-4">
    @if($class->scheduled_at)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 3px solid #f59e0b;">
            <div class="card-body p-3">
                <h6 class="small text-muted mb-1">Scheduled Date</h6>
                <p class="mb-0 fw-bold" style="color: #f59e0b;">
                    <i class="fas fa-calendar-alt me-1"></i>{{ $class->scheduled_at->format('M d, Y') }}
                </p>
                <small class="text-muted">{{ $class->scheduled_at->format('h:i A') }}</small>
            </div>
        </div>
    </div>
    @endif
    
    @if($class->duration)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 3px solid #10b981;">
            <div class="card-body p-3">
                <h6 class="small text-muted mb-1">Duration</h6>
                <p class="mb-0 fw-bold" style="color: #10b981;">
                    <i class="fas fa-hourglass-half me-1"></i>{{ $class->duration }}
                </p>
            </div>
        </div>
    </div>
    @endif
    
    @if($class->meeting_link)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; border-left: 3px solid #2563eb;">
            <div class="card-body p-3">
                <h6 class="small text-muted mb-1">Meeting Link</h6>
                <a href="{{ $class->meeting_link }}" target="_blank" class="btn btn-sm btn-primary w-100" style="border-radius: 8px;">
                    <i class="fas fa-video me-1"></i>Join Meeting
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

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
                </div>
                
                @if($material->description)
                <p class="text-muted small mb-3">{{ Str::limit($material->description, 100) }}</p>
                @endif
                
                @if($material->type == 'video' && $material->file_path)
                <!-- Video Player - No Download -->
                <div class="mb-3">
                    <div class="position-relative" style="border-radius: 10px; overflow: hidden; background: #000; padding-top: 56.25%; width: 100%;">
                        @php
                            $fileExtension = strtolower(pathinfo($material->file_name, PATHINFO_EXTENSION));
                            $mimeType = 'video/mp4';
                            if ($fileExtension == 'webm') $mimeType = 'video/webm';
                            elseif ($fileExtension == 'ogg' || $fileExtension == 'ogv') $mimeType = 'video/ogg';
                            elseif ($fileExtension == 'mov') $mimeType = 'video/quicktime';
                            elseif ($fileExtension == 'avi') $mimeType = 'video/x-msvideo';
                            $videoUrl = $material->file_url;
                        @endphp
                        <video 
                            controls 
                            controlsList="nodownload" 
                            disablePictureInPicture 
                            preload="auto"
                            playsinline
                            webkit-playsinline
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;"
                            oncontextmenu="return false;"
                            class="video-player"
                            id="video-{{ $material->id }}"
                            data-video-url="{{ $videoUrl }}"
                            data-video-id="{{ $material->id }}">
                            <source src="{{ $videoUrl }}" type="{{ $mimeType }}">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            <source src="{{ $videoUrl }}" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    @if($material->file_size)
                    <p class="small mb-0 text-muted mt-2">
                        <i class="fas fa-info-circle me-1"></i>Size: {{ number_format($material->file_size / 1024 / 1024, 2) }} MB
                    </p>
                    @endif
                </div>
                @else
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
                
                <div class="d-grid gap-2">
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
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body text-center p-5">
        <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">No Materials Available</h5>
        <p class="text-muted mb-0">No materials have been added to this class yet. Check back later!</p>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prevent video downloads and handle video playback
    const videoPlayers = document.querySelectorAll('.video-player');
    
    videoPlayers.forEach(function(video) {
        // Disable right-click context menu
        video.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable keyboard shortcuts (Ctrl+S, Ctrl+Shift+S, etc.)
        video.addEventListener('keydown', function(e) {
            // Prevent Ctrl+S, Ctrl+Shift+S, Ctrl+A
            if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S' || e.key === 'a' || e.key === 'A')) {
                e.preventDefault();
                return false;
            }
            // Prevent F12 (Developer Tools)
            if (e.key === 'F12') {
                e.preventDefault();
                return false;
            }
        });
        
        // Remove download option from controls (if browser supports it)
        video.setAttribute('controlsList', 'nodownload');
        video.setAttribute('disablePictureInPicture', 'true');
        
        // Prevent drag and drop
        video.addEventListener('dragstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Additional protection: prevent saving via browser menu
        video.addEventListener('loadstart', function() {
            // Remove download attribute if somehow added
            if (video.hasAttribute('download')) {
                video.removeAttribute('download');
            }
        });
        
        // Handle video loading errors
        video.addEventListener('error', function(e) {
            console.error('Video loading error:', e);
            console.error('Video URL:', video.getAttribute('data-video-url'));
            console.error('Video error code:', video.error ? video.error.code : 'unknown');
            console.error('Video error message:', video.error ? video.error.message : 'unknown');
            
            const errorMsg = document.createElement('div');
            errorMsg.className = 'alert alert-danger mt-2';
            let errorText = 'Unable to load video. ';
            if (video.error) {
                switch(video.error.code) {
                    case 1: errorText += 'MEDIA_ERR_ABORTED - Video loading aborted.'; break;
                    case 2: errorText += 'MEDIA_ERR_NETWORK - Network error while loading video.'; break;
                    case 3: errorText += 'MEDIA_ERR_DECODE - Video decoding error.'; break;
                    case 4: errorText += 'MEDIA_ERR_SRC_NOT_SUPPORTED - Video format not supported.'; break;
                    default: errorText += 'Unknown error occurred.';
                }
            } else {
                errorText += 'Please check if the file exists and try again.';
            }
            errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>' + errorText;
            video.parentElement.parentElement.appendChild(errorMsg);
        });
        
        // Log when video is ready
        video.addEventListener('loadedmetadata', function() {
            console.log('Video metadata loaded:', {
                duration: video.duration,
                videoWidth: video.videoWidth,
                videoHeight: video.videoHeight,
                url: video.getAttribute('data-video-url')
            });
        });
        
        // Handle video can play
        video.addEventListener('canplay', function() {
            console.log('Video can start playing');
        });
        
        // Handle video load start
        video.addEventListener('loadstart', function() {
            console.log('Video load started:', video.getAttribute('data-video-url'));
        });
        
        // Handle video stalled
        video.addEventListener('stalled', function() {
            console.warn('Video stalled - network issue');
        });
        
        // Handle video waiting
        video.addEventListener('waiting', function() {
            console.log('Video waiting for data');
        });
    });
    
    // Prevent text selection on video container
    const videoContainers = document.querySelectorAll('.position-relative');
    videoContainers.forEach(function(container) {
        if (container.querySelector('.video-player')) {
            container.style.userSelect = 'none';
            container.style.webkitUserSelect = 'none';
            container.style.mozUserSelect = 'none';
            container.style.msUserSelect = 'none';
        }
    });
});
</script>
@endsection
@endsection
