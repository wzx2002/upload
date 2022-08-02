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
     * 封装
     * @param string $bucket
     * @param string $filename
     * @param string|null $file
     * @return string
     * @throws UploadException
     * @throws \Exception
     */
    public function extracted(string $bucket, string $filename, ?string $file, bool $isMulti = false): string
    {
        $instance = OssUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            if($isMulti) {
                return $instance->getOssClient()->multiuploadFile($bucket ?: $this->bucket, $filename, $file)['oss-request-url'];
            }else{
                return $instance->getOssClient()->uploadFile($bucket ?: $this->bucket, $filename, $file)['oss-request-url'];
            }
        } catch (OssException $e) {
            throw new UploadException($e->getMessage());
        }
    }
}