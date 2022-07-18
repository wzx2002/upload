<?php

namespace Wzx2002\Upload\Base;

class BaseUpload
{
    public string $bucket;

    public array $config;

    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }
}