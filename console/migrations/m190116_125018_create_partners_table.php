<?php

use yii\db\Migration;

/**
 * Handles the creation of table `logos`.
 */
class m190116_125018_create_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xpartners_logos', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'file' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->batchInsert('xpartners_logos', ['name', 'description', 'url', 'file', 'status', 'created_at', 'updated_at'], [
          ['Geknology', 'Descripción para Geknology', 'www.geknology.com', 'geknology.png', 1, 0, 0],
          ['Edbarq Arquitectura', 'Descripción para Edbarq Arquitectura', 'www.edbarqarquitectura.cl', 'edbarq-arquitectura.jpg', 1, 0, 0],
          ['E. Loren', 'Descripción para E. Loren', 'www.eloren.cl', 'eloren.jpg', 1, 0, 0],
          ['Lady\'s', 'Descripción para Lady\'s Maquillaje Permanente', 'www.ladys.cl', 'ladys.jpg', 1, 0, 0],
          ['Todosana', 'Descripción para Todosana', 'www.todosana.cl', 'todosana.png', 1, 0, 0],
          ['Tu Dentista', 'Descripción para Tu Dentista', 'www.tudentista.cl', 'tudentista.jpg', 1, 0, 0],
          ['Ven Fit', 'Descripción para Ven Fit', 'www.venfit.cl', 'venfit.jpg', 1, 0, 0],
          ['Leo Style', 'Descripción para Leo Style', 'www.leostyle.cl', 'leostyle.png', 1, 0, 0],
          ['Aili Castro', 'Descripción para Aili Castro', 'www.ailicastro.cl', 'ailicastro.png', 1, 0, 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('xpartners_logos');
    }
}
