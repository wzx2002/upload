<h1 align="center"> upload </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require wzx2002/upload
```

## Usage

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
