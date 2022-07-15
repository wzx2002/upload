<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\WzxUpload;

class WzxUploadTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testOssUpload()
    {
        $config = [
            'accessKeyId' => '',
            'accessKeySecret' => '',
            'endpoint' => ''
        ];

        $file = WzxUpload::getInstance()->setUploadType(OssUploadImpl::getInstance())
            ->setConfig($config)->upload('www.php', 'wzx2002', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        $this->assertIsString($file);
    }
}