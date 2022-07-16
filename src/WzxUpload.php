<?php

namespace Wzx2002\Upload;

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
     * @param UploadInterface|null $uploadInstance
     * @return $this
     */
    public function setUploadInstance(?UploadInterface $uploadInstance): WzxUpload
    {
        $this->uploadInstance = $uploadInstance;
        return $this;
    }

    /**
     * 设置配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config): WzxUpload
    {
        $this->uploadInstance->setConfig($config);
        return $this;
    }

    /**
     * 默认bucket设置
     * @param string $bucket
     * @return $this
     */
    public function setBucket(string $bucket): WzxUpload
    {
        $this->uploadInstance->setBucket($bucket);
        return $this;
    }

    /**
     * 上传文件
     * @param string $file 文件名
     * @param string $filePath 文件路径
     * @param string $bucket
     * @return array
     */
    public function upload(string $file, string $filePath = '', string $bucket = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];

        try {
            $result['data'] = $this->uploadInstance->upload($file, $filePath, $bucket);
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