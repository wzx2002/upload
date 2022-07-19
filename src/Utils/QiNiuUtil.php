<?php

namespace Wzx2002\Upload\Utils;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Wzx2002\Upload\Exceptions\ConfigException;

class QiNiuUtil
{
    private static ?QiNiuUtil $instance = null;

    private string $accessKey;

    private string $secretKey;

    private string $domain;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return QiNiuUtil|null
     */
    public static function getInstance(): ?QiNiuUtil
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    public function getToken(string $bucket): string
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        return $auth->uploadToken($bucket);
    }

    public function getUploadMgr(): UploadManager
    {
        return new UploadManager();
    }

    /**
     * 设置配置
     * @param array $config
     * @return void
     * @throws ConfigException
     */
    public function setConfig(array $config)
    {
        if (empty($config['domain'])) {
            throw new ConfigException('domain不能为空');
        }
        $this->accessKey = $config['accessKey'] ?: '';
        $this->secretKey = $config['secretKey'] ?: '';
        $this->domain = $config['domain'];
    }
}