<?php

use yii\db\Migration;

/**
 * Handles the creation of table `appointments`.
 */
class m190508_080429_create_appointments_table extends Migration
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

        $this->createTable('{{%xclinic_appointments}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'date' => $this->dateTime()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xclinic_appointments-client_id',
            'xclinic_appointments',
            'client_id'
        );

        $this->createIndex(
            'idx-xclinic_appointments-service_id',
            'xclinic_appointments',
            'service_id'
        );

        $this->addForeignKey(
            'fk-xclinic_appointments-client_id',
            'xclinic_appointments',
            'client_id',
            'xclinic_clients',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-xclinic_appointments-service_id',
            'xclinic_appointments',
            'service_id',
            'xclinic_services',
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
            'fk-xclinic_appointments-service_id',
            'xclinic_appointments'
        );

        $this->dropForeignKey(
            'fk-xclinic_appointments-client_id',
            'xclinic_appointments'
        );

        $this->dropIndex(
            'idx-xclinic_appointments-service_id',
            'xclinic_appointments'
        );

        $this->dropIndex(
            'idx-xclinic_appointments-client_id',
            'xclinic_appointments'
        );

        $this->dropTable('{{%xclinic_appointments}}');
    }
}
