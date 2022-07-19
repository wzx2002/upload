<h1 align="center"> upload </h1>


## 简介
    
整合阿里云&七牛云&腾讯云存储的上传功能

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
    
    WzxUpload::getInstance()
            ->setUploadInstance(OssUploadImpl::getInstance())
            ->setConfig($oss_config)
            ->upload($filename, $file, $bucket);
```


#### 七牛云

```php
    $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => '',
        'domain' => ''
    ];
    
    WzxUpload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($qi_niu_config)
            ->upload($filename, $file, $bucket);
```


#### 腾讯云COS

```php
    $cos_config = [
        'secretId' => '',
        'secretKey' => '',
        'region' => ''
    ];
    
    WzxUpload::getInstance()
            ->setUploadInstance(CosUploadImpl::getInstance())
            ->setConfig($qi_niu_config)
            ->upload($filename, $file, $bucket);
```


## License

MIT
