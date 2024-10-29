<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m241029_084141_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(),
            'text' => $this->string(),
            'is_correct' => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey(
            'fk_answers_question_id',
            'answers',
            'question_id',
            'questions',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%answers}}');
    }
}
