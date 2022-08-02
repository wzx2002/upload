<?php

namespace Wzx2002\Upload\Interfaces;

interface UploadInterface
{
    /**
     * 文件上传
     * @param string|null $file 文件
     * @param string $bucket
     * @param string $filename 自定义文件名称
     * @return mixed
     */
    public function upload(?string $file, string $bucket, string $filename);

    /**
     * 分片上传
     * @param string|null $file
     * @param string $bucket
     * @param string $filename
     * @return mixed
     */
    public function multiUploadFile(?string $file, string $bucket, string $filename);
}