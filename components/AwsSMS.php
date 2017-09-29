<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */


namespace modernkernel\sms\components;


use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;
use modernkernel\sms\models\Setting;
use modernkernel\sms\models\SMS;
use yii\base\InvalidConfigException;
use yii\base\Object;

/**
 * Class AwsSMS
 * @package modernkernel\sms\components
 */
class AwsSMS extends Object
{

    protected $credentials;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $key = Setting::getValue('aws_access_key');
        $secret = Setting::getValue('aws_secret_key');

        if (empty($key)) {
            throw new InvalidConfigException($this->className() . '::key cannot be empty.');
        }
        if (empty($secret)) {
            throw new InvalidConfigException($this->className() . '::secret cannot be empty.');
        }
        $this->credentials = new Credentials($key, $secret);

    }

    /**
     * send sms
     * @param $to
     * @param $text
     * @return bool
     */
    public function send($to, $text)
    {
        $region = Setting::getValue('aws_region');
        $client = new SnsClient([
            'credentials' => $this->credentials,
            'region' => $region,
            'version' => '2010-03-31'
        ]);

        /* sms */
        $response = $client->publish([
            'Message' => $text,
            'PhoneNumber' => $to,
        ]);
        $result = $response->toArray();// ['MessageId'];
        if (!empty($result['MessageId'])) {
            $sms = new SMS();
            $sms->sms_id = $result['MessageId'];
            $sms->text = $text;
            $sms->to = $to;
            $sms->save();
            return true;
        }
        return false;
    }
}