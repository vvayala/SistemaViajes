<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct(
        Cloudinary $cloudinary
    ) {
        $this->cloudinary = $cloudinary;
    }

    public function upload(
        $file,
        $folder
    )
    {
        $result =
            $this->cloudinary
                ->uploadApi()
                ->upload(
                    $file->getRealPath(),
                    [
                        'folder' => $folder
                    ]
                );

        return $result['secure_url'];
    }
}