<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes}}`.
 */
class m241023_061730_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-notes-user_id',
            'notes',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-notes-user_id', 'notes');
        $this->dropTable('{{%notes}}');
    }
}
