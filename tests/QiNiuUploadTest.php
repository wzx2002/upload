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
        $instance = Upload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance());
        $instance->setConfig($this->qi_niu_config);
        $instance->setBucket('wzx2002');
        $res = $instance->upload('Upload.php');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}