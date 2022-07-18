<?php

namespace Wzx2002\Upload\Interfaces;

interface UploadInterface
{
    public function upload(string $filename, string $file, string $bucket);

    public function setConfig(array $config);

    public function setBucket(string $bucket);
}