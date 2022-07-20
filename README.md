<h1 align="center"> upload </h1>

## 简介

整合阿里云&七牛云&腾讯云存储的上传功能
支持tp和laravel框架, base64图片上传

## 安装

```shell
$ composer require wzx2002/upload
```

## 使用

#### 阿里云OSS

```php
    $oss_config = [
        'accessKeyId' => '',
        'accessKeySecret' => '',
        'endpoint' => ''
    ];
    
    Upload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance())
            ->setConfig($oss_config)
            ->upload($file);
```

#### 七牛云

```php
    $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => '',
        'domain' => ''
    ];
    
    Upload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($qi_niu_config)
            ->upload($file);
```

#### 腾讯云COS

```php
    $cos_config = [
        'secretId' => '',
        'secretKey' => '',
        'region' => ''
    ];
    
    Upload::getInstance()
            ->setUploadInstance(CosUploadImpl::getInstance())
            ->setConfig($qi_niu_config)
            ->upload($file);
```

#### 其他使用

```php
    $instance = Upload::getInstance()
            ->setUploadInstance(CosUploadImpl::getInstance());
    $instance->setConfig($cos_config);
    $instance->setBucket($bucket);
    $instance->upload($file);
```

## License

MIT
