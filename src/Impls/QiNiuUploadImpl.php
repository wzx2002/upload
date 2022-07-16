<?php

namespace Wzx2002\Upload\Impls;

use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;
use Wzx2002\Upload\Utils\QiNiuUtils;

class QiNiuUploadImpl implements UploadInterface
{
    private static ?QiNiuUploadImpl $instance = null;

    private array $config = [];

    private string $bucket;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return QiNiuUploadImpl|null
     */
    public static function getInstance(): ?QiNiuUploadImpl
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
     * @throws UploadException
     */
    public function upload(string $file, string $filePath, string $bucket)
    {
        $instance = QiNiuUtils::getInstance();
        $instance->setConfig($this->config);
        $token = $instance->getToken($bucket ?: $this->bucket);

        list($res, $error) = $instance->getUploadMgr()->putFile($token, $file, $filePath);
        if (is_null($res)) {
            throw new UploadException($error->getMessage());
        }

        return $res;
    }

    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }
}