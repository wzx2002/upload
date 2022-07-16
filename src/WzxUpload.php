<?php

namespace Wzx2002\Upload;

use JetBrains\PhpStorm\ArrayShape;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;

final class  WzxUpload
{
    private static ?WzxUpload $instance = null;

    private ?UploadInterface $uploadInstance = null;

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
     * @return array
     */
    public function upload(string $file, string $bucket = '', string $filePath = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];

        try {
            $result['data'] = $this->uploadInstance->upload($file, $bucket, $filePath);
        } catch (UploadException $e) {
            $result['msg'] = $e->getMessage();
            $result['errCode'] = -1;
        } catch (\Exception $e) {
            $result['msg'] = "上传异常";
            $result['errCode'] = -2;
        }

        return $result;
    }
}