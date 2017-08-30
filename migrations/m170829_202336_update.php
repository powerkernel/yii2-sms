<?php

use yii\db\Migration;

/**
 * Class m170829_202336_update
 */
class m170829_202336_update extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn('{{%sms_logs}}', 'id', 'sms_id');
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /* settings */
        $this->createTable('{{%sms_settings}}', [
            'key' => $this->string()->notNull(),
            'title' => $this->string()->null(),
            'value' => $this->string()->null(),
        ], $tableOptions);
        $this->addPrimaryKey('pk', '{{%sms_settings}}', 'key');
        $this->insert('{{%sms_settings}}', ['key' => 'aws_region', 'title'=>'AWS Region', 'value' => 'ap-southeast-1']);
        $this->insert('{{%sms_settings}}', ['key' => 'aws_access_key', 'title'=>'AWS Access Key ID', 'value' => '']);
        $this->insert('{{%sms_settings}}', ['key' => 'aws_secret_key', 'title'=>'AWS Secret Key', 'value' => '']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%sms_settings}}');
        $this->renameColumn('{{%sms_logs}}', 'sms_id', 'id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170829_202336_update cannot be reverted.\n";

        return false;
    }
    */
}
