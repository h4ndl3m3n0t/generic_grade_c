<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%school}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210728_102329_create_school_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(1024)->notNull(),
            'created_by' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-school-created_by}}',
            '{{%school}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-school-created_by}}',
            '{{%school}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-school-created_by}}',
            '{{%school}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-school-created_by}}',
            '{{%school}}'
        );

        $this->dropTable('{{%school}}');
    }
}
