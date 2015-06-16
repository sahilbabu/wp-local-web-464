<?php
error_reporting(0);
//ini_set('gd.jpeg_ignore_warning', true);
require_once( dirname(__FILE__) . '/wp-load.php' );
$blogurl = get_bloginfo('url');
// place this code inside a php file and call it f.e. "download.php"
$file = $_GET['file'];
if (!$file) {
    header("Location: $blogurl");
}
$allowed_ext = array ('gif','png','jpeg','jpg');
$file_split = explode('.', base64_decode($file));
$ext = end($file_split);
if(!in_array($ext, $allowed_ext)){
    header("Location: $blogurl");
}
$imageString = file_get_contents(base64_decode($file));
$doc_path = $_SERVER['DOCUMENT_ROOT'] . "/downloads/";
$imag_new_name = 'temp_dwn_file.'.$ext;
$save = file_put_contents($doc_path.$imag_new_name ,$imageString);

$download_file = $doc_path.$imag_new_name;
define('APPLICATION_PATH', dirname(__FILE__));
$doc_path = $_SERVER['DOCUMENT_ROOT'] . "/downloads/";
$url_path = site_url("/");
$path = str_replace($url_path, $doc_path, $download_file);

// list($download_file_w, $download_file_h) = getimagesize('path_to_image');
// change the path to fit your websites document structure
function resize_image_max($image, $max_width, $max_height) {
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) {
        $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
        return false;
    }

    if (($w <= $max_width) && ($h <= $max_height)) {
        return $image;
    } //no resizing needed
    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;

    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }

    $new_image = imagecreatetruecolor($new_w, $new_h);
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
    return $new_image;
}

function resize_image_crop($image, $width, $height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) {
        $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
        return false;
    }
    if (($w == $width) && ($h == $height)) {
        return $image;
    } //no resizing needed
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;

    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }

    $image2 = imagecreatetruecolor($new_w, $new_h);
    imagecopyresampled($image2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}

function resize_image_force($image, $width, $height) {
    ini_set("gd.jpeg_ignore_warning", 1);
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) {
        $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.';
        return false;
    }
    if (($w == $width) && ($h == $height)) {
        return $image;
    } //no resizing needed

    $image2 = imagecreatetruecolor($width, $height);
    imagecopyresampled($image2, $image, 0, 0, 0, 0, $width, $height, $w, $h);

    return $image2;
}

function resize_image($method, $image_loc, $new_loc, $width, $height) {

    if (!is_array(@$GLOBALS['errors'])) {
        $GLOBALS['errors'] = array();
    }

    if (!in_array($method, array('force', 'max', 'crop'))) {
        $GLOBALS['errors'][] = 'Invalid method selected.';
    }

    if (!$image_loc) {
        $GLOBALS['errors'][] = 'No source image location specified.';
    } else {
        if ((substr(strtolower($image_loc), 0, 7) == 'http://') || (substr(strtolower($image_loc), 0, 7) == 'https://')) { /* don't check to see if file exists since it's not local */
        } elseif (!file_exists($image_loc)) {
            $GLOBALS['errors'][] = 'Image source file does not exist.';
        }
        $extension = strtolower(substr($image_loc, strrpos($image_loc, '.')));
        if (!in_array($extension, array('.jpg', '.jpeg', '.png', '.gif', '.bmp'))) {
            $GLOBALS['errors'][] = 'Invalid source file extension!';
        }
    }

    if (!$new_loc) {
        $GLOBALS['errors'][] = 'No destination image location specified.';
    } else {
        $new_extension = strtolower(substr($new_loc, strrpos($new_loc, '.')));
        if (!in_array($new_extension, array('.jpg', '.jpeg', '.png', '.gif', '.bmp'))) {
            $GLOBALS['errors'][] = 'Invalid destination file extension!';
        }
    }

    $width = abs(intval($width));
    if (!$width) {
        $GLOBALS['errors'][] = 'No width specified!';
    }

    $height = abs(intval($height));
    if (!$height) {
        $GLOBALS['errors'][] = 'No height specified!';
    }

    if (count($GLOBALS['errors']) > 0) {
        echo_errors();
        return false;
    }
    if (in_array($extension, array('.jpg', '.jpeg'))) {
        $image = @imagecreatefromjpeg($image_loc);
    } elseif ($extension == '.png') {
        $image = @imagecreatefrompng($image_loc);
    } elseif ($extension == '.gif') {
        $image = @imagecreatefromgif($image_loc);
    } elseif ($extension == '.bmp') {
        $image = @imagecreatefromwbmp($image_loc);
    }

    if (!$image) {
        $GLOBALS['errors'][] = 'Image could not be generated!';
    } else {
        $current_width = imagesx($image);
        $current_height = imagesy($image);
        if ((!$current_width) || (!$current_height)) {
            $GLOBALS['errors'][] = 'Generated image has invalid dimensions!';
        }
    }
    if (count($GLOBALS['errors']) > 0) {
        @imagedestroy($image);
        echo_errors();
        return false;
    }

    if ($method == 'force') {
        $new_image = resize_image_force($image, $width, $height);
    } elseif ($method == 'max') {
        $new_image = resize_image_max($image, $width, $height);
    } elseif ($method == 'crop') {
        $new_image = resize_image_crop($image, $width, $height);
    }

    if ((!$new_image) && (count($GLOBALS['errors'] == 0))) {
        $GLOBALS['errors'][] = 'New image could not be generated!';
    }
    if (count($GLOBALS['errors']) > 0) {
        @imagedestroy($image);
        echo_errors();
        return false;
    }

    $save_error = false;
    if (in_array($extension, array('.jpg', '.jpeg'))) {
        imagejpeg($new_image, $new_loc) or ( $save_error = true);
    } elseif ($extension == '.png') {
        imagepng($new_image, $new_loc) or ( $save_error = true);
    } elseif ($extension == '.gif') {
        imagegif($new_image, $new_loc) or ( $save_error = true);
    } elseif ($extension == '.bmp') {
        imagewbmp($new_image, $new_loc) or ( $save_error = true);
    }
    if ($save_error) {
        $GLOBALS['errors'][] = 'New image could not be saved!';
    }
    if (count($GLOBALS['errors']) > 0) {
        @imagedestroy($image);
        @imagedestroy($new_image);
        echo_errors();
        return false;
    }

    imagedestroy($image);
    imagedestroy($new_image);

    return true;
}

function echo_errors() {
    if (!is_array(@$GLOBALS['errors'])) {
        $GLOBALS['errors'] = array('Unknown error!');
    }
    foreach ($GLOBALS['errors'] as $error) {
        echo '<p style="color:red;font-weight:bold;">Error: ' . $error . '</p>';
    }
}

if (isset($download_file)) {

    $new_loc_folder = $_SERVER['DOCUMENT_ROOT'] . "/tmp/";
    $url_path = site_url("/");
    $new_loc = str_replace($url_path, $url_path . $new_loc_folder, $download_file);

    define('APPLICATION_PATH', dirname(__FILE__));

    $info = new SplFileInfo($download_file);
    $file_extension = $info->getExtension();
    $file_basename = $info->getBasename();
    $file_name = $info->getFilename();
    $Download_Name = rand(99999, 9999999) . '_' . time() . '.' . $file_extension;
    
    output_file($download_file, $Download_Name, $file_extension);
}

function output_file($Source_File, $Download_Name, $file_extension = '') {
    /*
      $Source_File = path to a file to output
      $Download_Name = filename that the browser will see
      $mime_type = MIME type of the file (Optional)
     */
    if (!is_readable($Source_File))
        die('File not found or inaccessible!');

    $size = filesize($Source_File);
    $Download_Name = rawurldecode($Download_Name);

    /* Figure out the MIME type (if not specified) */
    $known_mime_types = array(
        "pdf" => "application/pdf",
        "csv" => "application/csv",
        "txt" => "text/plain",
        "html" => "text/html",
        "htm" => "text/html",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "png" => "image/png",
        "jpeg" => "image/jpg",
        "jpg" => "image/jpg",
        "php" => "text/plain"
    );

    // if ($file_extension == '') {
    //     //  $file_extension = strtolower(substr(strrchr($Source_File,"."),1));
    //     if (array_key_exists($file_extension, $known_mime_types)) {
    //         $mime_type = $known_mime_types[$file_extension];
    //     } else {
    //         $mime_type = "application/force-download";
    //     };
    // };

    if ($file_extension) {
        //  $file_extension = strtolower(substr(strrchr($Source_File,"."),1));
        if (array_key_exists($file_extension, $known_mime_types)) {
            $mime_type = $known_mime_types[$file_extension];
        } else {
            $mime_type = "application/force-download";
        }
    }else {
        $mime_type = "application/force-download";
    }
    
    @ob_end_clean(); //off output buffering to decrease Server usage
    // if IE, otherwise Content-Disposition ignored
    if (ini_get('zlib.output_compression'))
        ini_set('zlib.output_compression', 'Off');

    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="' . $Download_Name . '"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');

    header("Cache-control: private");
    header('Pragma: private');
    //header("Expires: Thu, 26 Jul 2012 05:00:00 GMT");
    header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));

    // multipart-download and download resuming support
    if (isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
        list($range) = explode(",", $range, 2);
        list($range, $range_end) = explode("-", $range);
        $range = intval($range);
        if (!$range_end) {
            $range_end = $size - 1;
        } else {
            $range_end = intval($range_end);
        }

        $new_length = $range_end - $range + 1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length = $size;
        header("Content-Length: " . $size);
    }

    /* output the file itself */
    $chunksize = 1 * (1024 * 1024); //you may want to change this
    $bytes_send = 0;
    if ($Source_File = fopen($Source_File, 'r')) {
        if (isset($_SERVER['HTTP_RANGE']))
            fseek($Source_File, $range);

        while (!feof($Source_File) &&
        (!connection_aborted()) &&
        ($bytes_send < $new_length)
        ) {
            $buffer = fread($Source_File, $chunksize);
            print($buffer); //echo($buffer); // is also possible
            flush();
            $bytes_send += strlen($buffer);
        }
        fclose($Source_File);
    } else
        die('Error - can not open file.');
    unlink($Source_File);
    die();
}

?>
