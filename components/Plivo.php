<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2017 Modern Kernel
 */


namespace modernkernel\sms\components;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;

/**
 * Class Plivo
 * @package modernkernel\sms\components
 */
class Plivo extends Component
{
    public $url = 'https://api.plivo.com';
    public $version = 'v1';
    public $auth_id;
    public $auth_token;

    protected $api;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->url)) {
            throw new InvalidConfigException($this->className() . '::url cannot be empty.');
        }
        if (empty($this->version)) {
            throw new InvalidConfigException($this->className() . '::version cannot be empty.');
        }
        if (empty($this->auth_id)) {
            throw new InvalidConfigException($this->className() . '::auth_id cannot be empty.');
        }
        if (empty($this->auth_token)) {
            throw new InvalidConfigException($this->className() . '::auth_token cannot be empty.');
        }
        $this->api = $this->url . "/" . $this->version . "/Account/" . $this->auth_id;
    }

    /**
     * send a message
     * @param array $params
     * @return mixed
     */
    public function send_message($params = array())
    {
        return $this->request('POST', 'Message/', $params);
    }

    /**
     * call API request
     * @param $method
     * @param $url
     * @param $params
     * @return string
     */
    protected function request($method, $url, $params)
    {
        $client = new Client(['baseUrl' => $this->api]);
        $act = 'get';
        if ($method == 'POST') {
            $act = 'post';
        }
        return $client->$act($url, $params)->send()->getContent();
    }
}