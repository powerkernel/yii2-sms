<?php

/**
 * Class m170830_004657_setting
 */
class m170830_004657_setting extends \yii\mongodb\Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $col=Yii::$app->mongodb->getCollection('sms_settings');
        $col->createIndexes([
            [
                'key'=>['key'],
                'unique'=>true,
            ]
        ]);
        $this->insert('sms_settings', ['key' => 'aws_region', 'title'=>'AWS Region', 'value' => 'ap-southeast-1']);
        $this->insert('sms_settings', ['key' => 'aws_access_key', 'title'=>'AWS Access Key ID', 'value' => '']);
        $this->insert('sms_settings', ['key' => 'aws_secret_key', 'title'=>'AWS Secret Key', 'value' => '']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m170830_004657_setting cannot be reverted.\n";
        return false;
    }
}
