<?php

use yii\db\Migration;

/**
 * Class m210810_055307_alter_grade_column_grade_system_table
 */
class m210810_055307_alter_grade_column_grade_system_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%grade_system}}','grade','NUMERIC(3,2) NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%grade_system}}','grade',$this->float(2)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210810_055307_alter_grade_column_grade_system_table cannot be reverted.\n";

        return false;
    }
    */
}
