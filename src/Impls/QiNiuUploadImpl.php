<?php

namespace Wzx2002\Upload\Impls;

use Qiniu\Config;
use Qiniu\Http\Error;
use Qiniu\Http\Request;
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
     */
    public function upload(string $filename, ?string $file, string $bucket): string
    {
        $instance = QiNiuUtil::getInstance();
        $instance->setConfig($this->config);
        $token = $instance->getToken($bucket ?: $this->bucket);

        list($res, $error) = $instance->getUploadMgr()->putFile($token, $filename, $file);

        if ($error instanceof \Exception) {
            throw new UploadException($error->getMessage());
        } elseif ($error instanceof Error) {
            throw new UploadException($error->message());
        }

        return $this->config['domain'] . DIRECTORY_SEPARATOR . $res['key'];
    }

}