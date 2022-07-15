<?php

namespace Wzx2002\Upload\Impls;

class QiNiuUploadImpl
{
    private static ?QiNiuUploadImpl $instance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return QiNiuUploadImpl|null
     */
    public static function getInstance(): ?QiNiuUploadImpl
    {
        if (!self::$instance instanceof self) {
            return new self();
        }

        return self::$instance;
    }

    private function upload($file)
    {
        return $file;
    }
}