<?php

namespace Wzx2002\Upload\Utils;

use Qcloud\Cos\Client;

class CosUtil
{
    private static ?CosUtil $instance = null;

    private string $secretId;
    private string $secretKey;
    private string $region;

    private function __clone()
    {
    }

    private function __construct()
    {

    }

    /**
     * @return CosUtil|null
     */
    public static function getInstance(): ?CosUtil
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    /**
     * 获取Client
     * @return Client
     */
    public function getCosClient(): Client
    {
        return new Client(
            array(
                'region' => $this->region,
                'credentials' => array(
                    'secretId' => $this->secretId,
                    'secretKey' => $this->secretKey)));
    }

    /**
     * 设置配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config): CosUtil
    {
        $this->secretId = $config['secretId'] ?: '';
        $this->secretKey = $config['secretKey'] ?: '';
        $this->region = $config['region'] ?: '';

        return $this;
    }
}