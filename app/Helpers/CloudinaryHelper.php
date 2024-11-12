<?php

namespace App\Helpers;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Config\Cloudinary;

class CloudinaryHelper extends Cloudinary
{
    public function upload($file, $options = []) {
        $config = new Configuration();
        $config->cloud->cloudName = $this->cloudName;
        $config->cloud->apiKey = $this->apiKey;
        $config->cloud->apiSecret = $this->apiSecret;
        $config->url->secure(true);

        $uploader = new UploadApi($config);
        $uploadResult = $uploader->upload($file, $options);
        
        if ($uploadResult) {
            return $uploadResult;
        } else {
            return false;
        }
    }


    // public function upload($file, $options = []) {
    //     $config = new Configuration();
    //     $config->cloud->cloudName = $this->cloudName;
    //     $config->cloud->apiKey = $this->apiKey;
    //     $config->cloud->apiSecret = $this->apiSecret;
    //     $config->url->secure(true);

    //     if (!isset($options['folder'])) {
    //         $options['folder'] = 'food-fiend';
    //     }

    //     $uploader = new UploadApi($config);
    //     $uploadResult = $uploader->upload($file, $options);
        
    //     if ($uploadResult) {
    //         return $uploadResult;
    //     } else {
    //         return false;
    //     }
    // }

}