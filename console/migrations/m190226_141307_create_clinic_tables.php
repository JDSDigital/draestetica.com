<?php

use yii\db\Migration;

/**
 * Class m190226_141307_create_clinic_tables
 */
class m190226_141307_create_clinic_tables extends Migration
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

        $this->createTable('xclinic_services_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xclinic_services_subcategories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('xclinic_services', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->null(),
            'subcategory_id' => $this->integer()->null(),
            'name' => $this->string()->notNull(),
            'summary' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'file' => $this->string()->null(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-xclinic_services-category_id',
            'xclinic_services',
            'category_id'
        );

        $this->createIndex(
            'idx-xclinic_services-subcategory_id',
            'xclinic_services',
            'subcategory_id'
        );

        $this->addForeignKey(
            'fk-xclinic_services-category_id',
            'xclinic_services',
            'category_id',
            'xclinic_services_categories',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-xclinic_services-subcategory_id',
            'xclinic_services',
            'subcategory_id',
            'xclinic_services_subcategories',
            'id',
            'SET NULL'
        );

        $this->batchInsert('xclinic_services_categories', ['name'], [
            ['Faciales'],
            ['Corporales'],
        ]);

        $this->batchInsert('xclinic_services_subcategories', ['name'], [
            ['No Invasivos'],
            ['Invasivos'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-xclinic_services-subcategory_id',
            'xclinic_services'
        );

        $this->dropForeignKey(
            'fk-xclinic_services-category_id',
            'xclinic_services'
        );

        $this->dropIndex(
            'idx-xclinic_services-subcategory_id',
            'xclinic_services'
        );

        $this->dropIndex(
            'idx-xclinic_services-category_id',
            'xclinic_services'
        );

        $this->dropTable('xclinic_services');
        $this->dropTable('xclinic_services_subcategories');
        $this->dropTable('xclinic_services_categories');
    }
}
