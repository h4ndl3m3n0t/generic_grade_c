<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%semester}}`
 * - `{{%school}}`
 * - `{{%user}}`
 */
class m210728_105615_create_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subject}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(40)->notNull(),
            'description' => $this->string(256),
            'grade' => $this->double(2)->notNull(),
            'sem_id' => $this->integer(11),
            'school_id' => $this->integer(11),
            'created_by' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `sem_id`
        $this->createIndex(
            '{{%idx-subject-sem_id}}',
            '{{%subject}}',
            'sem_id'
        );

        // add foreign key for table `{{%semester}}`
        $this->addForeignKey(
            '{{%fk-subject-sem_id}}',
            '{{%subject}}',
            'sem_id',
            '{{%semester}}',
            'id',
            'CASCADE'
        );

        // creates index for column `school_id`
        $this->createIndex(
            '{{%idx-subject-school_id}}',
            '{{%subject}}',
            'school_id'
        );

        // add foreign key for table `{{%school}}`
        $this->addForeignKey(
            '{{%fk-subject-school_id}}',
            '{{%subject}}',
            'school_id',
            '{{%school}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-subject-created_by}}',
            '{{%subject}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-subject-created_by}}',
            '{{%subject}}',
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
        // drops foreign key for table `{{%semester}}`
        $this->dropForeignKey(
            '{{%fk-subject-sem_id}}',
            '{{%subject}}'
        );

        // drops index for column `sem_id`
        $this->dropIndex(
            '{{%idx-subject-sem_id}}',
            '{{%subject}}'
        );

        // drops foreign key for table `{{%school}}`
        $this->dropForeignKey(
            '{{%fk-subject-school_id}}',
            '{{%subject}}'
        );

        // drops index for column `school_id`
        $this->dropIndex(
            '{{%idx-subject-school_id}}',
            '{{%subject}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-subject-created_by}}',
            '{{%subject}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-subject-created_by}}',
            '{{%subject}}'
        );

        $this->dropTable('{{%subject}}');
    }
}
