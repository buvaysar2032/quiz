<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_attempts}}`.
 */
class m241029_074542_create_user_attempts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%user_attempts}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'remaining_attempts' => $this->integer()->defaultValue(3),
            'last_reset' => $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_user_attempts_user_id',
            'user_attempts',
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
        $this->dropTable('{{%user_attempts}}');
    }
}
