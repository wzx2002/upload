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

    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param string $file 文件名
     * @param string $bucket
     * @param string $filePath 文件路径
     * @return null
     * @throws UploadException
     */
    public function upload(string $file, string $bucket, string $filePath)
    {
        $instance = OssUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            return $instance->getOssClient()->uploadFile($bucket, $file, $filePath)['oss-request-url'];
        } catch (OssException $e) {
            throw new UploadException($e->getMessage());
        }
    }
}