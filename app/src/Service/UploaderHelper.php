<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;

class UploaderHelper
{
    private $uploadsPath;

    public function __construct(string $uploadsPath) {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadProductImage(UploadedFile $uploadedFile): string {
        $destination = $this->uploadsPath;

        $originalFilename = pathInfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

}
