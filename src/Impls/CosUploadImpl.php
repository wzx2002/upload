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
        $instance = CosUtil::getInstance();
        $instance->setConfig($this->config);
        try {
            if($isMulti) {
                return $instance->getCosClient()->Upload(
                    $bucket ?: $this->bucket,
                    $filename,
                    $file
                )['Location'];
            }else{
                return $instance->getCosClient()->putObject(array(
                    'Bucket' => $bucket ?: $this->bucket,
                    'Key' => $filename,
                    'Body' => $file
                ))['Location'];
            }
        } catch (\Exception $e) {
            throw new UploadException($e->getMessage());
        }
    }
}