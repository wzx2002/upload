<?php

namespace Wzx2002\Upload\Impls;

use Wzx2002\Upload\Interfaces\UploadInterface;

class UploadImpl implements UploadInterface
{
    private static ?UploadImpl $instance = null;

    private function __clone()
    {
    }

    private function __construct()
    {
    }

    /**
     * @return UploadImpl|null
     */
    public static function getInstance(): ?UploadImpl
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