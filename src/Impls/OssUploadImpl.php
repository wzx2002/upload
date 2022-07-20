<?php

namespace Wzx2002\Upload\Impls;

use OSS\Core\OssException;
use Wzx2002\Upload\Base\BaseUpload;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;
use Wzx2002\Upload\Utils\OssUtil;

class OssUploadImpl extends BaseUpload implements UploadInterface
{
    private static ?OssUploadImpl $instance = null;

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

    /**
     * @param string $filename 文件名
     * @param string|null $file 文件路径
     * @param string $bucket
     * @return string
     * @throws UploadException
     */
    public function upload(?string $file, string $bucket, string $filename): string
    {
        $instance = OssUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            return $instance->getOssClient()->uploadFile($bucket ?: $this->bucket, $filename, $file)['oss-request-url'];
        } catch (OssException $e) {
            throw new UploadException($e->getMessage());
        }
    }
}