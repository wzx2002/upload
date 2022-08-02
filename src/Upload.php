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
     * 文件上传
     * @param string|null $file 文件
     * @param string $dir 目录
     * @param string $bucket
     * @param string $filename 自定义文件名称
     * @return array
     */
    public function upload(?string $file, string $dir = '', string $bucket = '', string $filename = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];

        try {
            $result['data'] = $this->baseUpload($file, $dir, $bucket, $filename);
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
     * 多图上传
     * @param array|null $files
     * @param string $dir
     * @param string $bucket
     * @param string $filename
     * @return array
     */
    public function uploadMany(?array $files, string $dir = '', string $bucket = '', string $filename = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];

        try {
            foreach ($files as $file) {
                $result['data'][] = $this->baseUpload($file, $dir, $bucket, $filename);
            }
        } catch (UploadException $e) {
            $result['msg'] = $e->getMessage();
            $result['errCode'] = -1;
        }

        return $result;
    }

    /**
     * 上传封装
     * @param string|null $file
     * @param string $dir
     * @param string $bucket
     * @param string $filename
     * @return mixed
     * @throws UploadException
     */
    public function baseUpload(?string $file, string $dir, string $bucket, string $filename)
    {
        try {
            $str = strstr($file, ',', true);
            $regex = "/^data:image\/\w{3,4};base64$/";
            if (preg_match($regex, $str)) {
                $file = $this->Base64ToImage($file);
            } else {
                $file = $this->makeImage($file);
            }
            $filename = $this->makeFilename($file, $filename, $dir);
            $image = $this->uploadInstance->upload($file, $bucket, $filename);
        } catch (UploadException $e) {
            throw new UploadException($e->getMessage());
        } finally {
            if (file_exists($file)) {
                @unlink($file);
            }
        }

        return $image;
    }

    /**
     * 分片上传
     * @param string|null $file
     * @param string $dir
     * @param string $bucket
     * @param string $filename
     * @return array
     */
    public function multiUploadFile(?string $file, string $dir = '', string $bucket = '', string $filename = ''): array
    {
        $result = [
            'data' => [],
            'msg' => '上传成功',
            'errCode' => 0
        ];
        try {
            $file = $this->makeImage($file);
            $filename = $this->makeFilename($file, $filename, $dir);
            $result['data'] = $this->uploadInstance->multiuploadFile($file, $bucket, $filename);
        } catch (UploadException $e) {
            $result['msg'] = $e->getMessage();
            $result['errCode'] = -1;
        } finally {
            if (file_exists($file)) {
                @unlink($file);
            }
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
     * @param string $dir
     * @return string
     */
    private function makeFilename(?string $file, string $filename, string $dir): string
    {
        if (empty($filename)) {
            $ext = strrchr($file, '.');
            $filename = date('YmdHis') . '-' . md5($file) . '-' . time() . $ext;
        }


        return empty($dir) ? $filename : $dir . '/' . $filename;
    }

    /**
     * 获取base64图片生成文件
     * @param string|null $file
     * @return string
     * @throws UploadException
     */
    private function Base64ToImage(?string $file): string
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $matches)) {
            $ext = $matches[2];
            $base64_decode = base64_decode(explode(',', $file)[1]);
            $path = md5(time() . date('Ymd')) . '.' . $ext;
            if (file_put_contents($path, $base64_decode)) {
                return $path;
            }
        }

        throw new UploadException("base64 转换失败");
    }

    /**
     * 生成图片
     * @throws UploadException
     */
    public function makeImage(?string $file): string
    {
        $content = file_get_contents($file);
        $file = getimagesize($file);
        if (!empty($file)) {
            $ext = substr($file['mime'], 6);
            $path = md5(time() . date('Ymd')) . '.' . $ext;
            if (file_put_contents($path, $content)) {
                return $path;
            }
        }
        throw new UploadException("image 生成失败");
    }
}