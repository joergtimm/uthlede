<?php


namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Process\Process;

class UploaderHelper
{
    const ARTIKEL_IMAGE = 'artikel_image';
    const THEMEN_IMAGE = 'themen_image';
    const PERSON_IMAGE = 'person_image';
    const IMAGE = 'image';

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

    public function uploadPersonImage(UploadedFile $uploadedFile): string
    {

        $destination = $this->getUploadPath().'/'.self::PERSON_IMAGE;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid('PersonImage', true).'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
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

    public function uploadVereinsLogo(UploadedFile $uploadedFile): string
    {

        $destination = $this->getUploadPath().'/'.self::IMAGE;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid('Image', true).'.'.$uploadedFile->guessExtension();

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

    public function reCacheThumbs(string $relPath, array $filters ): string
    {
        foreach ($filters as $filter)
        {
            $command = sprintf(
                './bin/console liip:imagine:cache:resolve %s --filter=%s',
                $relPath,
                $filter
            );

            $process = Process::fromShellCommandline($command);
            $process->setWorkingDirectory(__DIR__ . '/../../');
            $process->setTimeout(3600);
            $process->enableOutput();
            $process->run();
        }

        return $relPath;
    }


}