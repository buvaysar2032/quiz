<?php

use yii\db\Migration;

/**
 * Class m241029_134708_add_last_attempt_reset_to_user_table
 */
class m241029_134708_add_last_attempt_reset_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'last_attempt_reset', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'last_attempt_reset');
    }
}
