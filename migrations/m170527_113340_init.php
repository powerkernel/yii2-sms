<?php

use yii\db\Migration;

/**
 * Class m170527_113340_init
 */
class m170527_113340_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /* invoice */
        $this->createTable('{{%sms_logs}}', [
            'message_uuid' => $this->string(64)->notNull(),
            'parent_message_uuid' => $this->string(64)->notNull(),


            'to' => $this->string(13)->notNull(),
            'from' => $this->string(13)->notNull(),

            'part_info' => $this->string()->null(),
            'total_rate' => $this->string()->null(),
            'total_amount' => $this->string()->null(),
            'units' => $this->string()->null(),
            'mcc' => $this->string()->null(),
            'mnc' => $this->string()->null(),
            'error_code' => $this->string()->null(),

            'text'=>$this->string()->null(),

            'result' => $this->string()->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('pk', '{{%sms_logs}}', ['message_uuid']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%sms_logs}}');
    }


}
