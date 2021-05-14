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
        $filePath = str_replace("/","\\",$filePath);
    }
    else
    {
        $filePath = str_replace("\\","/",$filePath);
    }
}

function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags); 
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
    }
    return $files;
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
