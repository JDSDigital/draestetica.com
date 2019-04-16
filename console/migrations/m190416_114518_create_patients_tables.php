<?php

use yii\db\Migration;

/**
 * Class m190416_114518_create_patients_tables
 */
class m190416_114518_create_patients_tables extends Migration
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

        $this->createTable('{{%xclinic_patients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'rut' => $this->integer()->notNull()->unique(),
            'birthday' => $this->date()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('{{%xclinic_patients_notes}}', [
            'id' => $this->primaryKey(),
            'patient_id' => $this->integer()->null(),
            'note' => $this->text()->notNull(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xclinic_patients_notes-patient_id',
            'xclinic_patients_notes',
            'patient_id'
        );

        $this->addForeignKey(
            'fk-xclinic_patients_notes-patient_id',
            'xclinic_patients_notes',
            'patient_id',
            'xclinic_patients',
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
            'fk-xclinic_patients_notes-patient_id',
            'xclinic_patients_notes'
        );

        $this->dropIndex(
            'idx-xclinic_patients_notes-patient_id',
            'xclinic_patients_notes'
        );

        $this->dropTable('{{%xclinic_patients_notes}}');
        $this->dropTable('{{%xclinic_patients}}');
    }
}
