<?php


namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const ARTIKEL_IMAGE = 'artikel_image';
    const THEMEN_IMAGE = 'themen_image';

    private $uploadsPath;
    private $filesystem;

    public function __construct(string $uploadsPath, Filesystem $filesystem)
    {
        $this->uploadsPath = $uploadsPath;
        $this->filesystem = $filesystem;
    }

    public function getUploadPath()
    {
        return $this->uploadsPath;
    }


    public function uploadArtikelImage(UploadedFile $uploadedFile): string
    {

        $destination = $this->getUploadPath().'/'.self::ARTIKEL_IMAGE;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid('ArtikelImage', true).'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }


    public function uploadThemenImage(UploadedFile $uploadedFile): string
    {

        $destination = $this->getUploadPath().'/'.self::THEMEN_IMAGE;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid('ThemenImage', true).'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function deleteFile(string $path)
    {
        if(file_exists($path)) {
            $this->filesystem->remove($path);
        }



    }


}