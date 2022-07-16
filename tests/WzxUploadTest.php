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
            'accessKeyId' => 'LTAI5t7PuXPCfassXRsvYP6n',
            'accessKeySecret' => 'FOgMgSmh89uHSvrembfwrAwaz72SV6',
            'endpoint' => 'http://wzx2002.oss-cn-beijing.aliyuncs.com'
        ];

        $res = WzxUpload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance())
            ->setConfig($config)
            ->upload('www.php', 'wzx2002', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        print_r($res);

        $this->assertEquals('0', $res['errCode']);
    }

    public function testQiNiuUpload()
    {
        $config = [
            'accessKey' => 'Xvm5AJxlnhvbTQKlkqMgdj3ggRq0JzPhmJkNVrI_',
            'secretKey' => '5KFIj3gAnzCSbp7uLBPlIEw1DhRH94KDs26-fMdr'
        ];

        $res = WzxUpload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($config)
            ->upload('www.php', 'wzx2002', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        print_r($res);

        $this->assertEquals('-1', $res['errCode']);
    }
}