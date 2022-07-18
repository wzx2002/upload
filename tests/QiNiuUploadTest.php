<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\QiNiuUploadImpl;
use Wzx2002\Upload\WzxUpload;

class QiNiuUploadTest extends TestCase
{
    private array $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => ''
    ];

    public function testQiNiuUpload()
    {
        $res = WzxUpload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($this->qi_niu_config)
            ->upload('www.php', 'D:\phpstudy_pro\WWW\test\upload\src\WzxUpload.php', 'wzx2002');

        print_r($res);

        $this->assertEquals('0', $res['errCode']);
    }
}