<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\QiNiuUploadImpl;
use Wzx2002\Upload\Upload;

class QiNiuUploadTest extends TestCase
{
    private array $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => '',
        'domain' => ''
    ];

    public function testQiNiuUpload()
    {
        $res = Upload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($this->qi_niu_config)
            ->upload('www.php', 'Upload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}