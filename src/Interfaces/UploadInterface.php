<?php

namespace Wzx2002\Upload\Interfaces;

interface UploadInterface
{
    public function upload(string $file,string $bucket,string $filePath);
}