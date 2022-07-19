<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\CosUploadImpl;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\Upload;

class CosUploadTest extends TestCase
{
    private array $cos_config = [
        'secretId' => '',
        'secretKey' => '',
        'region' => ''
    ];


    public function testOssUpload()
    {
        $res = Upload::getInstance()
                ->setUploadInstance(CosUploadImpl::getInstance())
            ->setConfig($this->cos_config)
            ->upload('www.php', 'Upload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}