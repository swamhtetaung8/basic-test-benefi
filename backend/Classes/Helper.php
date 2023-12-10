<?php

namespace Classes;

require 'vendor/autoload.php';

class Helper
{
    public static function response($status, $data, $statusCode = 200, string $message = null)
    {
        header('Content-Type: application/json');

        http_response_code($statusCode);

        $responseObject = [
            'status' => $status,
            'data' => $data,
            'message' => $message
        ];

        $jsonResponse = json_encode($responseObject);

        if ($jsonResponse === false) {
            http_response_code(500);
            $jsonResponse = json_encode([
                'status' => 500,
                'data' => null,
                'message' => "Internal Server Error"
            ]);
        }

        echo $jsonResponse;

        return $jsonResponse;
    }

    public static function handleFileUploadError($errorCode)
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
            case UPLOAD_ERR_FORM_SIZE:
                return "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
            case UPLOAD_ERR_PARTIAL:
                return "The uploaded file was only partially uploaded.";
            case UPLOAD_ERR_NO_FILE:
                return "No file was uploaded.";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Missing a temporary folder. Introduced in PHP 5.0.3.";
            case UPLOAD_ERR_CANT_WRITE:
                return "Failed to write file to disk. Introduced in PHP 5.1.0.";
            case UPLOAD_ERR_EXTENSION:
                return "A PHP extension stopped the file upload.";
            default:
                return "Unknown error.";
        }
    }

    public static function moveUploadedFile($file, $destinationDirectory, $newFileName)
    {
        $uploadedFilePath = $file["tmp_name"];
        $destinationFilePath = $destinationDirectory . "/" . $newFileName;

        if (move_uploaded_file($uploadedFilePath, $destinationFilePath)) {
            return $destinationFilePath;
        } else {
            return false;
        }
    }

    public static function createDestinationDirectory($destinationDirectory)
    {
        if (!is_dir($destinationDirectory)) {
            if (mkdir($destinationDirectory)) {
                return true;
            }
        }
        return false;
    }
}
