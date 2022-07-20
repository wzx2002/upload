<?php

namespace Wzx2002\Upload\Impls;

use Wzx2002\Upload\Base\BaseUpload;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;
use Wzx2002\Upload\Utils\CosUtil;

class CosUploadImpl extends BaseUpload implements UploadInterface
{
    private static ?CosUploadImpl $instance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return CosUploadImpl|null
     */
    public static function getInstance(): ?CosUploadImpl
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }


    /**
     * @param string|null $file
     * @param string $bucket
     * @param string $filename
     * @return string
     * @throws UploadException
     */
    public function upload(?string $file, string $bucket, string $filename): string
    {
        $instance = CosUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            return $instance->getCosClient()->putObject(array(
                'Bucket' => $bucket ?: $this->bucket,
                'Key' => $filename,
                'Body' => $file
            ))['Location'];
        } catch (\Exception $e) {
            throw new UploadException($e->getMessage());
        }
    }
}