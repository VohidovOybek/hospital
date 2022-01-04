<?php


namespace Warehouse\Request;


class Request
{


    public function getPath()
    {
        $path_as_string = $_SERVER['REQUEST_URI'] ?? "/";
        $query_start_pos = strpos($path_as_string, '?');
        if ($query_start_pos) {
            return substr($path_as_string, 0, $query_start_pos);
        }
        return $path_as_string;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']); // POST, GET => get, post
    }

    public function getBody()
    {
        if ($this->getMethod() === 'get') {
            return $_GET;
        }
        if ($this->getMethod() === 'post') {
            return $_POST;
        }
    }

    public function getJsonBody()
    {
        $entityBody = file_get_contents('php://input');
        return json_decode($entityBody, true);
    }

    public function hasFile(string $name)
    {
        if ($_FILES[$name]) {
            return true;
        }
        return false;
    }

    public function saveFile($name, $path = '/')
    {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/";
        if ($path !== '/') {
            $target_dir .= $path . "/";
            if (!is_dir($target_dir) && !mkdir($target_dir, 0777)){
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $target_dir));
        }
        }
        $target_file = $target_dir . basename($_FILES[$name]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // "jpg, png"
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$name]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            return $target_file;
        }

// Check file size
        if ($_FILES[$name]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'gif', 'png'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk === 0) {
            return false;
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
                $path = $_SERVER['DOCUMENT_ROOT'] . "/assets";
                return substr($target_file, strlen($path));
            } else {
                return false;
            }
        }
    }
}