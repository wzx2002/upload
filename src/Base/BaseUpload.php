<?php

namespace Wzx2002\Upload\Base;

use Wzx2002\Upload\Exceptions\UploadException;

abstract class BaseUpload
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

    abstract function extracted(string $bucket, string $filename, ?string $file);

    /**
     * 文件上传
     * @param string $filename 文件名
     * @param string|null $file 文件路径
     * @param string $bucket
     * @return string
     * @throws UploadException
     */
    public function upload(?string $file, string $bucket, string $filename): string
    {
        return $this->extracted($bucket, $filename, $file);
    }

    /**
     * 分片上传
     * @param string $filename 文件名
     * @param string|null $file 文件路径
     * @param string $bucket
     * @return string
     * @throws UploadException
     */
    public function multiUploadFile(?string $file, string $bucket, string $filename): string
    {
        return $this->extracted($bucket, $filename, $file, true);
    }
}