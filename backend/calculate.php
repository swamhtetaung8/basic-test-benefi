<?php

require 'vendor/autoload.php';

use Classes\CalculateController;
use Classes\Helper;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

const UPLOAD_DIR = "uploads";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    # Check for errors during file upload
    if ($file["error"] == UPLOAD_ERR_OK) {

        $mime = mime_content_type($file['tmp_name']);

        # Check if the file type is txt
        if ($mime !== "text/plain") {
            Helper::response("error", null, 400, "Only text/plain files are allowed");
        }
        $fileName =  pathinfo($file["name"], PATHINFO_FILENAME) . time() . '.txt';
        $destinationDirectory = UPLOAD_DIR;
        Helper::createDestinationDirectory($destinationDirectory);

        $destinationFilePath = Helper::moveUploadedFile($file, $destinationDirectory, $fileName);

        # Check if moving uploaded file from temporary directory succeeded
        if ($destinationFilePath !== false) {
            $executeCalculation = new CalculateController();
            $executeCalculation->processInstructions($fileName);
        } else {
            Helper::response("error", null, 400, "Unable to move the uploaded file.");
        }
    } else {
        $fileUploadError = Helper::handleFileUploadError($file["error"]);
        Helper::response("error", null, 400, "File submit not successful.");
    }
} else {
    Helper::response("error", null, 400, "Invalid request.");
}
