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
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        /*$this->batchInsert('xpartners_logos', ['name', 'description', 'url', 'file'], [
          ['Geknology', 'Descripción para Geknology', 'https://www.geknology.com', 'geknology.png'],
          ['Edbarq Arquitectura', 'Descripción para Edbarq Arquitectura', 'https://www.edbarqarquitectura.cl', 'edbarq-arquitectura.jpg'],
          ['E. Loren', 'Descripción para E. Loren', 'https://www.eloren.cl', 'eloren.jpg'],
          ['Lady\'s', 'Descripción para Lady\'s Maquillaje Permanente', 'https://www.ladys.cl', 'ladys.jpg'],
          ['Todosana', 'Descripción para Todosana', 'https://www.todosana.cl', 'todosana.png'],
          ['Tu Dentista', 'Descripción para Tu Dentista', 'https://www.tudentista.cl', 'tudentista.jpg'],
          ['Ven Fit', 'Descripción para Ven Fit', 'https://www.venfit.cl', 'venfit.jpg'],
          ['Leo Style', 'Descripción para Leo Style', 'https://www.leostyle.cl', 'leostyle.png'],
          ['Aili Castro', 'Descripción para Aili Castro', 'https://www.ailicastro.cl', 'ailicastro.png'],
        ]);*/
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('xpartners_logos');
    }
}
