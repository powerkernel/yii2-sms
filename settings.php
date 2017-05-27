<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2016 Modern Kernel
 */

$s = [
    /* SMS */
    ['key' => 'snsAWSRegion', 'value' => '', 'title' => 'AWS Region', 'description' => 'AWS Region', 'group' => 'SMS', 'type' => 'textInput', 'data' => '[]', 'default' => '', 'rules' => json_encode(['string' => []])],
    ['key' => 'snsAWSAccessKeyId', 'value' => '', 'title' => 'AWS Access Key', 'description' => 'AWS Access Key ID', 'group' => 'SMS', 'type' => 'textInput', 'data' => '[]', 'default' => '', 'rules' => json_encode(['string' => []])],
    ['key' => 'snsAWSSecretKey', 'value' => '', 'title' => 'AWS Secret Key', 'description' => 'AWS Secret Key', 'group' => 'SMS', 'type' => 'passwordInput', 'data' => '[]', 'default' => '', 'rules' => json_encode(['string' => []])],
];
return $s;