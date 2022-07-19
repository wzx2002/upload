<?php

namespace Wzx2002\Upload;

use Wzx2002\Upload\Exceptions\ConfigException;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;

final class  Upload
{
    private static ?Upload $instance = null;

    private ?UploadInterface $uploadInstance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return Upload|null
     */
    public static function getInstance(): ?Upload
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
    public function setUploadInstance(?UploadInterface $uploadInstance): Upload
    {
        $this->uploadInstance = $uploadInstance;
        return $this;
    }

    /**
     * 设置配置
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config): Upload
    {
        $this->uploadInstance->setConfig($config);
        return $this;
    }

    /**
     * 上传文件
     * @param string|null $file 文件路径
     * @param string $filename 文件名
     * @param string $bucket
     * @return array
     */
    public function upload(?string $file, string $filename = '', string $bucket = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];

        $filename = $this->makeFilename($file, $filename);

        try {
            $result['data'] = $this->uploadInstance->upload($filename, $file, $bucket);
        } catch (UploadException|ConfigException $e) {
            $result['msg'] = $e->getMessage();
            $result['errCode'] = -1;
        } catch (\Exception $e) {
            $result['msg'] = $e->getMessage();
            $result['errCode'] = -2;
        }

        return $result;
    }

    /**
     * 默认bucket设置
     * @param string $bucket
     * @return $this
     */
    public function setBucket(string $bucket): Upload
    {
        $this->uploadInstance->setBucket($bucket);
        return $this;
    }

    /**
     * 生成文件名称
     * @param string|null $file
     * @param string $filename
     * @return string
     */
    private function makeFilename(?string $file, string $filename): string
    {
        if (empty($filename)) {
            $ext = strrchr($file, '.');
            $filename = date('Ymd') . '-' . md5($file) . $ext;
        }

        return $filename;
    }
}