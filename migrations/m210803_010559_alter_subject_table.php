<?php

use yii\db\Migration;

/**
 * Class m210803_010559_alter_subject_table
 */


/**
 * Class m210803_010559_alter_subject_table
 * Alter the data type of 'grade' column in table `{{%subject}}`.
 */
class m210803_010559_alter_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%subject}}','grade',$this->integer(11)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%subject}}','grade',$this->double(2)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210803_010559_alter_subject_table cannot be reverted.\n";

        return false;
    }
    */
}
