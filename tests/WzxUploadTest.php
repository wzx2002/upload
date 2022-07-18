<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\Impls\QiNiuUploadImpl;
use Wzx2002\Upload\WzxUpload;

class WzxUploadTest extends TestCase
{
    private array $oss_config = [
        'accessKeyId' => '',
        'accessKeySecret' => '',
        'endpoint' => ''
    ];

    private array $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => ''
    ];

    public function testOssUpload()
    {
        $res = WzxUpload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance())
            ->setConfig($this->oss_config)
            ->upload('www.php', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals('0', $res['errCode']);
    }

    public function testQiNiuUpload()
    {
        $res = WzxUpload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($this->qi_niu_config)
            ->upload('www.php', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals('-1', $res['errCode']);
    }

    public function testSetBucketOss()
    {
        $instance = WzxUpload::getInstance()->setUploadInstance(OssUploadImpl::getInstance());
        $instance->setBucket("wzx2002");
        $instance->setConfig($this->oss_config);
        $res = $instance->upload('test.jpg', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        print_r($res);

        $this->assertEquals('0', $res['errCode']);
    }

    public function testSetBucketQiNiu()
    {
        $instance = WzxUpload::getInstance()->setUploadInstance(QiNiuUploadImpl::getInstance());
        $instance->setBucket("wzx2002");
        $instance->setConfig($this->qi_niu_config);
        $res = $instance->upload('test.jpg', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php');

        print_r($res);

        $this->assertEquals('-1', $res['errCode']);
    }
}