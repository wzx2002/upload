<?php

namespace Wzx2002\Upload;

use ReflectionClass;
use ReflectionException;
use Wzx2002\Upload\Exceptions\UploadException;

final class  WzxUpload
{
    private static ?WzxUpload $instance = null;

    private $method = null;

    private $uploadInstance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return WzxUpload|null
     */
    public static function getInstance(): ?WzxUpload
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    /**
     * 上传设置类型和方法
     * @param $uploadInstance
     * @return $this
     */
    public function setUploadInstance($uploadInstance): WzxUpload
    {
        $this->uploadInstance = $uploadInstance;
        return $this;
    }

    /**
     * 设置配置
     * @param $config
     * @return $this
     */
    public function setConfig($config): WzxUpload
    {
        $this->uploadInstance->setConfig($config);
        return $this;
    }

    /**
     * 上传文件
     * @param string $file 文件名
     * @param string $bucket
     * @param string $filePath 文件路径
     * @return string
     * @throws UploadException
     */
    public function upload(string $file, string $bucket = '', string $filePath = ''): string
    {
        try {
            return $this->uploadInstance->upload($file, $bucket, $filePath);
        } catch (\Exception $e) {
            throw new UploadException("上传异常");
        }
    }
}