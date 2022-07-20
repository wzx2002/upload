<?php

namespace Wzx2002\Upload\Interfaces;

interface UploadInterface
{
    /**
     * @param string|null $file 文件
     * @param string $bucket
     * @param string $filename 自定义文件名称
     * @return mixed
     */
    public function upload(?string $file, string $bucket, string $filename);
}