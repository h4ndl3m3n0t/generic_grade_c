<?php

use yii\db\Migration;

/**
 * Class m210816_233227_create_default_user_account
 */
class m210816_233227_create_default_user_account extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'username' => 'seeker',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password' => Yii::$app->security->generatePasswordHash('seekmenot'),
            'email' => 'seek@me.com',
            'status' => 10,
            'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}',[
            'username' => 'handler',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password' => Yii::$app->security->generatePasswordHash('handlermenot'),
            'email' => 'handle@me.com',
            'status' => 10,
            'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}',['username' => 'handler']);
        $this->delete('{{%user}}',['username' => 'seeker']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210816_233227_create_default_user_account cannot be reverted.\n";

        return false;
    }
    */
}
