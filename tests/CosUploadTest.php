<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\CosUploadImpl;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\Upload;

class CosUploadTest extends TestCase
{
    private array $cos_config = [
        'secretId' => 'AKIDue7oENFqADzUifKiupSouiFVZMr52i7F',
        'secretKey' => 'sTnqb6JFuHOEn57sLXT8VbQebGelb9RS',
        'region' => 'ap-shanghai'
    ];


    public function testOssUpload()
    {
        $instance = Upload::getInstance()
            ->setUploadInstance(CosUploadImpl::getInstance());
        $instance->setConfig($this->cos_config);
        $instance->setBucket('wzx2002-1302535132');
        $res = $instance->upload('Upload.php');

        print_r($res);

        $this->assertEquals(0, $res['errCode']);
    }
}