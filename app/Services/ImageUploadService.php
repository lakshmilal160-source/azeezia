<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class ImageUploadService
{
    private int $webpQuality = 85;

    private array $passthroughMimes = [
        'image/svg+xml',
        'image/svg',
        'image/x-icon',
        'image/vnd.microsoft.icon',
    ];

    public function upload(
        UploadedFile $file,
        string $folder = 'uploads'
    ): string {
        $baseName = Str::slug(
            pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            )
        );

        $baseName = $baseName ?: 'image';

        // Keep SVG and ICO files as-is
        if (in_array($file->getMimeType(), $this->passthroughMimes, true)) {
            $extension = strtolower(
                $file->getClientOriginalExtension() ?: 'svg'
            );

            $filename = $baseName.'-'.uniqid().'.'.$extension;

            return $file->storeAs($folder, $filename, 'public');
        }

        $path = $folder.'/'.$baseName.'-'.uniqid().'.webp';

        $manager = new ImageManager(new Driver);

        // Intervention Image v4
        $image = $manager->decodePath($file->getRealPath());

        $encoded = $image->encodeUsingFormat(
            Format::WEBP,
            quality: $this->webpQuality
        );

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

    }
}
