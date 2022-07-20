<?php

namespace Wzx2002\Upload\Impls;

use Qiniu\Http\Error;
use Wzx2002\Upload\Base\BaseUpload;
use Wzx2002\Upload\Exceptions\ConfigException;
use Wzx2002\Upload\Exceptions\UploadException;
use Wzx2002\Upload\Interfaces\UploadInterface;
use Wzx2002\Upload\Utils\QiNiuUtil;

class QiNiuUploadImpl extends BaseUpload implements UploadInterface
{
    private static ?QiNiuUploadImpl $instance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return QiNiuUploadImpl|null
     */
    public static function getInstance(): ?QiNiuUploadImpl
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }


    /**
     * @param string $filename 文件名
     * @param string|null $file 文件路径
     * @param string $bucket
     * @return string
     * @throws UploadException
     * @throws ConfigException
     * @throws \Exception
     */
    public function upload(?string $file, string $bucket, string $filename): string
    {
        $instance = QiNiuUtil::getInstance();
        if (!$this->config['domain']) {
            throw new ConfigException('domain is empty');
        }
        $instance->setConfig($this->config);
        $token = $instance->getToken($bucket ?: $this->bucket);

        list($res, $error) = $instance->getUploadMgr()->putFile($token, $filename, $file);

        if ($error instanceof \Exception) {
            throw new UploadException($error->getMessage());
        } elseif ($error instanceof Error) {
            throw new UploadException($error->message());
        }

        return $this->config['domain'] . '/' . $res['key'];
    }
}