<h1 align="center"> upload </h1>

<p align="center"> .</p>

## 简介
    
对阿里OSS以及七牛云进行上传整合

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
            ->upload($filename, $path, $bucket);
```

#### 七牛云


```php
    $qi_niu_config = [
        'accessKey' => '',
        'secretKey' => ''
    ];
    
    WzxUpload::getInstance()
            ->setUploadInstance(QiNiuUploadImpl::getInstance())
            ->setConfig($qi_niu_config)
            ->upload($filename, $path, $bucket);
```


## License

MIT
