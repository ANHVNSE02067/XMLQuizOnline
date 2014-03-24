<?php
class Uploader
{
    public static $IMG_ALLOW_EXTS = array('gif', 'jpeg', 'jpg', 'png');
    public static $IMG_ALLOW_TYPES = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/png');
    public static function uploadImage($key = 'img', $path =  IMG_PATH)
    {
        $file_path = null; 
        try {
            if (!isset($_FILES[$key])) {
                throw new Exception('No file posted!');
            }
            $temp = explode(".", $_FILES[$key]["name"]);
            $extension = end($temp);
            if (in_array($_FILES[$key]["type"], self::$IMG_ALLOW_TYPES)
                && ($_FILES[$key]["size"] < 20000)
                && in_array($extension, self::$IMG_ALLOW_EXTS)) {
                if ($_FILES[$key]["error"] > 0) {
                    echo "Error: " . $_FILES[$key]["error"] . "<br>";
                } else {
                    echo "Upload: " . $_FILES[$key]["name"] . "<br>";
                    echo "Type: " . $_FILES[$key]["type"] . "<br>";
                    echo "Size: " . ($_FILES[$key]["size"] / 1024) . " kB<br>";
                    echo "Stored in: " . $_FILES[$key]["tmp_name"];
                }
            } else {
                echo "Invalid file";
            }
        } catch (Exception $e) {
        }

            return $file_path;
    }

    public static function uploadImages($key = 'img', $path = IMG_PATH)
    {

    }
}
