<?php

use yii\db\Migration;

/**
 * Class m210803_011754_create_subject_grade_system_relationship
 */
class m210803_011754_create_subject_grade_system_relationship extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         // creates index for column `grade`
        $this->createIndex(
            '{{%idx-subject-grade}}',
            '{{%subject}}',
            'grade'
        );

        // add foreign key for table `{{%grade_system}}`
        $this->addForeignKey(
            '{{%fk-subject-grade}}',
            '{{%subject}}',
            'grade',
            '{{%grade_system}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%grade_system}}`
        $this->dropForeignKey(
            '{{%fk-subject-grade}}',
            '{{%subject}}'
        );

        // drops index for column `grade`
        $this->dropIndex(
            '{{%idx-subject-grade}}',
            '{{%subject}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210803_011754_create_subject_grade_system_relationship cannot be reverted.\n";

        return false;
    }
    */
}
