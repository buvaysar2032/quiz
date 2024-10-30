<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz_progress}}`.
 */
class m241030_132843_create_quiz_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%quiz_progress}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'current_question_id' => $this->integer(),
            'current_question_index' => $this->integer(),
            'correct_answers' => $this->integer(),
            'start_time' => $this->integer(),
            'end_time' => $this->integer(),
            'status' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-quiz-progress-user_id',
            'quiz_progress',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%quiz_progress}}');
    }

}
