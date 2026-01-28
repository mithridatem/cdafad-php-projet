<?php

namespace App\Service;

use App\Utils\Tools;
use App\Service\UploadException;

class UploadService
{
    private const string UPLOAD_DIRECTORY = "assets/img/";
    private const int UPLOAD_SIZE_MAX = 1024 * 1024 * 2;
    private const array UPLOAD_FORMAT_WHITE_LIST = ["png", "jpeg", "jpg", "webp"];

    /**
     * Méthode pour uploader un fichier
     * @param array $files (super globale Files)
     * @param string $name (nom du fichier)
     * @return string Nom de l'image uploadée
     * @throws UploadException
     */
    public function uploadFile(array $files): string
    {
        //Test si le fichier est bien uplodé
        if ($this->isFileUploadCorrectly($files)) {
            throw new UploadException("Pas de fichier à importer");
        }

        //test de la taille
        if ($this->validateUploadSize($files)) {
            throw new UploadException("La taille du fichier est trop importante");
        }

        //Récupération de l'extension
        $ext = Tools::getFileExtension($files["name"]);

        //Test si le format du fichier est valide
        if (!$this->validateUploadFormat($ext)) {
            throw new UploadException("Le format " . $ext . " est invalide");
        }

        //rename files
        $newName =  $this->renameFile($files);
        $uploadTmp = $files["tmp_name"];
        $uploadtarget = self::UPLOAD_DIRECTORY . $newName;

        //move to Upload_directory
        move_uploaded_file($uploadTmp, $uploadtarget);
        return $newName;
    }
    /**
     * Méthode pour tester si l'image à bien été uploadé
     * @param string $name (nom du fichier)
     * @return string Nom de l'image uploadée
     */
    private function isFileUploadCorrectly($files): bool
    {
        return !isset($files["tmp_name"]) || empty($files["tmp_name"]);
    }

    private function validateUploadSize(array $files): bool
    {
        return $files["size"] > self::UPLOAD_SIZE_MAX;
    }

    private function validateUploadFormat(string $ext): bool
    {
        return in_array($ext, self::UPLOAD_FORMAT_WHITE_LIST);
    }

    private function renameFile(array $files): string
    {
        return uniqid() . $files["name"];
    }
}
