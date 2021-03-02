<?php

function clearCache()
    {
        $cachePath = __DIR__.'/Cache';
        correctPath($cachePath);
        deleteDirectory($cachePath);
    }

function isOSWindowns():bool{
    return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
}

function correctPath(&$filePath){
    if (isOSWindowns())
    {
        $filePath = '//'.$filePath;
    }
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

function createFileIfNeed($filePath)
{
    correctPath($filePath);
    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }
}

function fileExists($filePath): bool 
{
    correctPath($filePath);
    return file_exists($filePath);
}

function filePutContents($filePath,$content,$mode = null) 
{
    correctPath($filePath);
    file_put_contents($filePath,  $content, $mode);
}

function fileGetContents($filePath) 
{
    correctPath($filePath);
    return file_get_contents($filePath);
}

function createPath($path) {
    correctPath($path);
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

function exportFile($content, $filePath) {
    file_put_contents($filePath, '<?php'.PHP_EOL);
    file_put_contents($filePath,  $content, FILE_APPEND);
}

function deleteAllFiles($path) {
    correctPath($path);
    $files = getAllFileNames($path);
    foreach($files as $file){
        if(is_file($file)) {
            unlink($file);
        }
    }
}

function getAllFileNames($path) {
    $files = glob($path.'/*');
    return $files;
}