<?php

use yii\db\Migration;

/**
 * Class m241030_082155_add_quiz_attempts_setting
 */
class m241030_082155_add_quiz_attempts_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%setting}}', [
            'parameter' => 'quiz_attempts',
            'value' => '3',
            'description' => 'Количество попыток для прохождения викторины',
            'type' => 'number'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%setting}}', ['parameter' => 'quiz_attempts']);
    }
}
