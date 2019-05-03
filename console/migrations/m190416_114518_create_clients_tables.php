<?php

use yii\db\Migration;

/**
 * Class m190416_114518_create_clients_tables
 */
class m190416_114518_create_clients_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%xclinic_clients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'rut' => $this->integer()->notNull()->unique(),
            'birthday' => $this->date()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('{{%xclinic_clients_notes}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->null(),
            'note' => $this->text()->notNull(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xclinic_clients_notes-client_id',
            'xclinic_clients_notes',
            'client_id'
        );

        $this->addForeignKey(
            'fk-xclinic_clients_notes-client_id',
            'xclinic_clients_notes',
            'client_id',
            'xclinic_clients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-xclinic_clients_notes-client_id',
            'xclinic_clients_notes'
        );

        $this->dropIndex(
            'idx-xclinic_clients_notes-client_id',
            'xclinic_clients_notes'
        );

        $this->dropTable('{{%xclinic_clients_notes}}');
        $this->dropTable('{{%xclinic_clients}}');
    }
}
