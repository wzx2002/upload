<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\Impls\QiNiuUploadImpl;
use Wzx2002\Upload\WzxUpload;

class WzxUploadTest extends TestCase
{
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

    public function testQiNiuUpload()
    {
        $config = [
            'accessKeyId' => 'Xvm5AJxlnhvbTQKlkqMgdj3ggRq0JzPhmJkNVrI_',
            'accessKeySecret' => '5KFIj3gAnzCSbp7uLBPlIEw1DhRH94KDs26-fMdr'
        ];

        $file = WzxUpload::getInstance()
            ->setUploadType(QiNiuUploadImpl::getInstance())
            ->setConfig($config)
            ->upload('www.php', 'wzx2002', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        $this->assertIsString($file);
    }
}