<?php

use PHPUnit\Framework\TestCase;
use Wzx2002\Upload\Impls\OssUploadImpl;
use Wzx2002\Upload\WzxUpload;

class WzxUploadTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testOssUpload()
    {
        $config = [
            'accessKeyId' => 'LTAI5t7PuXPCfassXRsvYP6n',
            'accessKeySecret' => 'FOgMgSmh89uHSvrembfwrAwaz72SV6',
            'endpoint' => 'http://wzx2002.oss-cn-beijing.aliyuncs.com'
        ];

        $file = WzxUpload::getInstance()->setUploadType(OssUploadImpl::getInstance())
            ->setConfig($config)->upload('www.jpg', 'wzx2002', 'D:\phpstudy_pro\WWW\test\upload\src\config.php');

        $this->assertIsString($file);
    }
}