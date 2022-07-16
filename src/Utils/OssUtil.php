<?php

namespace Wzx2002\Upload\Utils;

use OSS\Core\OssException;
use OSS\OssClient;

class OssUtil
{
    private static ?OssUtil $instance = null;

    private string $accessKeyId;
    private string $accessKeySecret;
    private string $endpoint;

    private function __clone()
    {
    }

    private function __construct()
    {

    }

    /**
     * @return OssUtil|null
     */
    public static function getInstance(): ?OssUtil
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    /**
     * 获取OssClient
     * @return OssClient
     * @throws OssException
     */
    public function getOssClient(): OssClient
    {
        return new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint, true);
    }

    /**
     * 设置配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config): OssUtil
    {
        $this->accessKeyId = $config['accessKeyId'] ?: '';
        $this->accessKeySecret = $config['accessKeySecret'] ?: '';
        $this->endpoint = $config['endpoint'] ?: '';

        return $this;
    }

}