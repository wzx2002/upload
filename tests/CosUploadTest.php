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
        'region' => 'ap-shanghai'
    ];


    public function testOssUpload()
    {
        $instance = Upload::getInstance()
            ->setUploadInstance(CosUploadImpl::getInstance());
        $instance->setConfig($this->cos_config);
        $instance->setBucket('wzx2002');
        $res = $instance->upload('http://wzx2002.oss-cn-beijing.aliyuncs.com/20220720131614-4d27e8c7f04898947b0942d6016b702a-1658294174.webp');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}