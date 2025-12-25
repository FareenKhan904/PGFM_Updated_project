<?php

namespace App\Http\Controllers;

use App\Models\ClassMaterial;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    /**
     * Download file (PDF, documents, etc.) with proper access control
     */
    public function download(ClassMaterial $material)
    {
        // Verify material exists and has a file
        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            abort(404, 'File not found');
        }
        
        // Verify user is authenticated
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }
        
        // Verify student is enrolled in the course (if material belongs to a class)
        if ($material->courseClass && $material->courseClass->course_id) {
            $enrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $material->courseClass->course_id)
                ->where('status', Enrollment::STATUS_ACCEPTED)
                ->first();
            
            if ((!$enrollment || $enrollment->isExpired()) && auth()->user()->type != 2) { // Allow doctors to view
                abort(403, 'You are not enrolled in this course or your enrollment has expired.');
            }
        }
        
        $filePath = Storage::disk('public')->path($material->file_path);
        $mimeType = $this->getMimeType($material->file_name);
        
        return Response::download($filePath, $material->file_name, [
            'Content-Type' => $mimeType,
        ]);
    }
    
    /**
     * Stream video file with proper headers for video playback
     */
    public function stream(ClassMaterial $material)
    {
        // Verify material exists and has a file
        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            abort(404, 'Video file not found');
        }
        
        // Verify user is authenticated
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }
        
        // Verify student is enrolled in the course (if material belongs to a class)
        if ($material->courseClass && $material->courseClass->course_id) {
            $enrollment = Enrollment::where('user_id', auth()->id())
                ->where('course_id', $material->courseClass->course_id)
                ->where('status', Enrollment::STATUS_ACCEPTED)
                ->first();
            
            if ((!$enrollment || $enrollment->isExpired()) && auth()->user()->type != 2) { // Allow doctors to view
                abort(403, 'You are not enrolled in this course or your enrollment has expired.');
            }
        }
        
        $filePath = Storage::disk('public')->path($material->file_path);
        $fileSize = filesize($filePath);
        $mimeType = $this->getMimeType($material->file_name);
        
        // Get range request for video seeking
        $range = request()->header('Range');
        
        if ($range) {
            // Parse range header
            list($unit, $range) = explode('=', $range, 2);
            if ($unit == 'bytes') {
                list($start, $end) = explode('-', $range);
                $start = intval($start);
                $end = $end ? intval($end) : $fileSize - 1;
                $length = $end - $start + 1;
                
                // Open file and seek to start position
                $file = fopen($filePath, 'rb');
                fseek($file, $start);
                
                // Set headers for partial content
                $headers = [
                    'Content-Type' => $mimeType,
                    'Content-Length' => $length,
                    'Content-Range' => "bytes $start-$end/$fileSize",
                    'Accept-Ranges' => 'bytes',
                    'Cache-Control' => 'public, max-age=3600',
                ];
                
                return Response::stream(function() use ($file, $length) {
                    echo fread($file, $length);
                    fclose($file);
                }, 206, $headers);
            }
        }
        
        // Full file response
        return Response::file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Length' => $fileSize,
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
    
    /**
     * Get MIME type based on file extension
     */
    private function getMimeType($fileName): string
    {
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            // Video types
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogg' => 'video/ogg',
            'ogv' => 'video/ogg',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'wmv' => 'video/x-ms-wmv',
            'flv' => 'video/x-flv',
            // Document types
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            // Text types
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            // Image types
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            // Audio types
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
        ];
        
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}

