<?php

namespace Wzx2002\Upload\Impls;

use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Utils\QiNiuUtils;

class QiNiuUploadImpl
{
    private static ?QiNiuUploadImpl $instance = null;

    private $config = [];

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

    private function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @throws UploadException
     */
    private function upload(string $file, string $bucket, string $filePath)
    {
        $instance = QiNiuUtils::getInstance();
        $instance->setConfig($this->config);
        $token = $instance->getToken($bucket);
        list($ret, $error) = $instance->getUploadMgr()->putFile($token, $file, $filePath);
        if (is_null($ret)) {
            throw new UploadException;
        }
        return $ret;
    }
}