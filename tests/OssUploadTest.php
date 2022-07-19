<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\Upload;

class OssUploadTest extends TestCase
{
    private array $oss_config = [
        'accessKeyId' => '',
        'accessKeySecret' => '',
        'endpoint' => ''
    ];


    public function testOssUpload()
    {
        $res = Upload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance())
            ->setConfig($this->oss_config)
            ->upload('www.php', 'Upload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}