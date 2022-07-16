<?php

namespace Wzx2002\Upload\Utils;

use JetBrains\PhpStorm\Pure;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiNiuUtils
{
    private static ?QiNiuUtils $instance = null;

    private $accessKey;

    private $secretKey;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return QiNiuUtils|null
     */
    public static function getInstance(): ?QiNiuUtils
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    public function getToken($bucket): string
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        return $auth->uploadToken($bucket);
    }

    public function getUploadMgr(): UploadManager
    {
        return new UploadManager();
    }

    public function setConfig($config)
    {
        $this->accessKey = $config['accessKey'];
        $this->secretKey = $config['secretKey'];
    }
}