<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%semester}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%school}}`
 * - `{{%user}}`
 */
class m210728_103958_create_semester_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%semester}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'school_id' => $this->integer(11),
            'created_by' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `school_id`
        $this->createIndex(
            '{{%idx-semester-school_id}}',
            '{{%semester}}',
            'school_id'
        );

        // add foreign key for table `{{%school}}`
        $this->addForeignKey(
            '{{%fk-semester-school_id}}',
            '{{%semester}}',
            'school_id',
            '{{%school}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-semester-created_by}}',
            '{{%semester}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-semester-created_by}}',
            '{{%semester}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%school}}`
        $this->dropForeignKey(
            '{{%fk-semester-school_id}}',
            '{{%semester}}'
        );

        // drops index for column `school_id`
        $this->dropIndex(
            '{{%idx-semester-school_id}}',
            '{{%semester}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-semester-created_by}}',
            '{{%semester}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-semester-created_by}}',
            '{{%semester}}'
        );

        $this->dropTable('{{%semester}}');
    }
}
