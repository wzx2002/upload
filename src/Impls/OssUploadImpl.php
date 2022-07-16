<?php

namespace Wzx2002\Upload\Impls;

use OSS\Core\OssException;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;
use Wzx2002\Upload\Utils\OssUtil;

class OssUploadImpl implements UploadInterface
{
    private static ?OssUploadImpl $instance = null;

    private array $config = [];

    private string $bucket;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return OssUploadImpl|null
     */
    public static function getInstance(): ?OssUploadImpl
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $file 文件名
     * @param string $filePath 文件路径
     * @param string $bucket
     * @return string
     * @throws UploadException
     */
    public function upload(string $file, string $filePath, string $bucket): string
    {
        $instance = OssUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            return $instance->getOssClient()->uploadFile($bucket ?: $this->bucket, $file, $filePath)['oss-request-url'];
        } catch (OssException $e) {
            throw new UploadException($e->getMessage());
        }
    }

    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }
}