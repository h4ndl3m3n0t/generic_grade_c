<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%grade_system}}`.
 */
class m210803_010409_create_grade_system_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%grade_system}}', [
            'id' => $this->primaryKey(),
            'grade' => $this->float(2)->notNull(),
            'equivalent' => $this->string(10)->notNull(),
            'grade_letter' => $this->string(2)->notNull(),
            'description' => $this->string(50)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);


        /**
         * generate data
         */
        $this->insert('{{%grade_system}}',[
            'grade' => 1.00,
            'equivalent' => '99 - 100',
            'grade_letter' => 'A',
            'description' => 'EXCELLENT',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 1.25,
            'equivalent' => '96 - 98',
            'grade_letter' => 'A-',
            'description' => 'VERY GOOD',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 1.50,
            'equivalent' => '93 - 95',
            'grade_letter' => 'B+',
            'description' => 'VERY GOOD',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 1.75,
            'equivalent' => '90 - 92',
            'grade_letter' => 'B',
            'description' => 'GOOD',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 2.00,
            'equivalent' => '87 - 89',
            'grade_letter' => 'B-',
            'description' => 'GOOD',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 2.25,
            'equivalent' => '84 - 86',
            'grade_letter' => 'C+',
            'description' => 'GOOD',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 2.50,
            'equivalent' => '81 - 83',
            'grade_letter' => 'C',
            'description' => 'FAIR',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 2.75,
            'equivalent' => '78 - 80',
            'grade_letter' => 'C-',
            'description' => 'PASSING',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 3.00,
            'equivalent' => '75 - 77',
            'grade_letter' => 'D',
            'description' => 'PASSING',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 5.00,
            'equivalent' => 'BELOW 70',
            'grade_letter' => 'F',
            'description' => 'FAILED',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        /**
         * other grade values
         */
        $this->insert('{{%grade_system}}',[
            'grade' => 4.00,
            'equivalent' => 'N\A',
            'grade_letter' => 'X',
            'description' => 'No Final Examination / No Final Requirement',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%grade_system}}',[
            'grade' => 0,
            'equivalent' => 'N\A',
            'grade_letter' => 'W',
            'description' => 'Withdrew or Dropped',
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%grade_system}}');
        $this->dropTable('{{%grade_system}}');
    }
}
