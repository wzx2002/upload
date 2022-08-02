<h1 align="center"> upload </h1>

## 简介

整合阿里云&七牛云&腾讯云存储的上传功能。支持tp和laravel框架。

-[x] `普通图片上传`

-[x] `base64图片上传`

-[x] `普通图片多图上传`

-[x] `base64图片多图上传`

-[x] `大文件分块上传`

## 安装

```shell
$ composer require wzx2002/upload
```

## 使用

```php
    // oss配置
    $oss_config = [
        'accessKeyId' => '',
        'accessKeySecret' => '',
        'endpoint' => ''
    ];
    
    // 七牛配置
    $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => '',
        'domain' => ''
    ];
    
    // cos配置
    $cos_config = [
        'secretId' => '',
        'secretKey' => '',
        'region' => 'ap-shanghai'
    ];
    
    // 获取实例
    $instance = Upload::getInstance();
    /*
     * 设置驱动实现
     * OssUploadImpl oss
     * QiNiuUploadImpl 七牛
     * CosUploadImpl cos
     */
    $instance->setUploadInstance(OssUploadImpl::getInstance());
    // 配置
    $instance->setConfig($oss_config);
    // 普通/base64/多图上传
    $instance->upload($file);
    // 分块上传
    $instance->multiUploadFile($file);
    
    /*
     * 返回 errCode 为0则成功
     * [
     *      'data' => [],
     *      'msg' => '上传成功',
     *      'errCode' => 0
     * ]
     */
    
```

## License

MIT
