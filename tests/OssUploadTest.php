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
        $instance = Upload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance());
        $instance->setConfig($this->oss_config);
        $instance->setBucket('wzx2002');
        $res = $instance->upload('Upload.php');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}