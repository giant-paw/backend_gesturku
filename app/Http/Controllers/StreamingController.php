<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamingController extends Controller
{
    public function stream(Request $request, $filename)
    {
        $filePath = urldecode($filename); 

        if (!Storage::disk('public')->exists($filePath)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        $fullPath = storage_path('app/public/' . $filePath);
        $size = filesize($fullPath);
        $mime = mime_content_type($fullPath);

        $start = 0;
        $end = $size - 1;

        if ($request->headers->has('Range')) {
            preg_match('/bytes=(\d+)-(\d*)/', $request->header('Range'), $matches);
            $start = intval($matches[1]);
            if (isset($matches[2]) && $matches[2] !== '') {
                $end = intval($matches[2]);
            }
        }

        $length = $end - $start + 1;

        $headers = [
            'Content-Type' => $mime,
            'Content-Length' => $length,
            'Content-Range' => "bytes $start-$end/$size",
            'Accept-Ranges' => 'bytes',
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
        ];

        return response()->stream(function () use ($fullPath, $start, $length) {
            $handle = fopen($fullPath, 'rb');
            fseek($handle, $start);
            $buffer = 8192;
            $sent = 0;
            while (!feof($handle) && $sent < $length) {
                $readLength = min($buffer, $length - $sent);
                echo fread($handle, $readLength);
                flush();
                $sent += $readLength;
            }
            fclose($handle);
        }, ($start > 0 || $length < $size) ? 206 : 200, $headers);
    }

}
