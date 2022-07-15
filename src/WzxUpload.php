<?php

namespace Wzx2002\Upload;

use ReflectionClass;
use ReflectionException;

class  WzxUpload
{
    private static ?WzxUpload $instance = null;

    private $method = null;

    private $uploadType = null;

    private ReflectionClass $reflectionClass;

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
     * 上传类型
     * @param $uploadType
     * @return $this
     * @throws \ReflectionException
     */
    public function setUploadType($uploadType): WzxUpload
    {
        $this->uploadType = $uploadType;
        $this->reflectionClass = new ReflectionClass($uploadType);
        $this->method = $this->reflectionClass->getMethod('upload');

        return $this;
    }

    /**
     * @param $config
     * @return $this
     * @throws ReflectionException
     */
    public function setConfig($config): WzxUpload
    {
        $set = $this->reflectionClass->getMethod('setConfig');
        $set->setAccessible(true);
        $set->invoke($this->uploadType, $config);

        return $this;
    }

    /**
     * 上传文件
     * @param string $file 文件名
     * @param string $bucket
     * @param string $filePath 文件路径
     * @return string
     */
    public function upload(string $file, string $bucket = '', string $filePath = ''): string
    {
        $this->method->setAccessible(true);
        return $this->method->invoke($this->uploadType, $file, $bucket, $filePath);
    }
}