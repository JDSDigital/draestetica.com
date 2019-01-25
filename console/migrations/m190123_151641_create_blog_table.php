<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m190123_151641_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xblog_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createTable('xblog_articles', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'summary' => $this->string()->notNull(),
            'article' => $this->text()->notNull(),
            'file' => $this->string()->null(),
            'author' => $this->string()->null(),
            'source' => $this->string()->null(),

            'views' => $this->integer()->notNull()->defaultValue(0),
            'featured' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->insert('xblog_tags', [
            'name' => 'Estética'
        ]);

        $this->insert('xblog_articles', [
          'tag_id' => 1,
          'title' => 'La piel, un mundo de sorpresas.',

          'summary' => 'Hola hoy te hablaré de la piel, pero... ¿Qué es la piel?, ¿Cuántos tipos de piel
              existen?, ¿Qué podemos hacer para mantenerla linda?, y ¿Cómo reconozco mi tipo de
              piel?, pues te contare esto y más.',

          'article' => '<p>Hola hoy te hablaré de la piel, pero... ¿Qué es la piel?, ¿Cuántos tipos de piel
              existen?, ¿Qué podemos hacer para mantenerla linda?, y ¿Cómo reconozco mi tipo de
              piel?, pues te contare esto y más.</p>

              <p>Empecemos, la piel es el órgano más extenso del cuerpo humano y posee múltiples
              funciones una de ellas actúa como barrera protectora frente al medio externo protegiéndola
              de agentes químicos, mecánicos o radiaciones ultravioletas y manteniendo la homeostasia
              internamente, también ayuda a la sensibilidad del dolor, tacto, presión y temperatura, la
              Termorregulación es otra de las funciones más importante a través de la dilatación y
              constricción de vasos por medio del sudor, entre infinidades de funciones que posee la piel.</p>

              <p>¿Cuántos tipos de piel existen?</p>

              <p>Se habla de 4 tipos de piel, te describiré a cada una de ellas y podrás identificar qué
              tipo de piel tienes para así aprender cómo cuidarla.</p>

              <p>En este primer blog te hablare de cuáles son las características de una piel normal
              y una piel seca además te daré algunos tips de cómo cuidarlas, en los próximas
              publicaciones te escribiré de los otros tipos de piel.</p>

              <p>PIELES NORMALES</p>

              <p>Médicamente se le llama a la piel normal “eudérmica” este tipo de piel es privilegiada
              puesto que el sebo (que es la grasa del rostro) y la hidratación están en equilibrio, esto hace
              que nuestra piel luzca hidratada y con un brillo natural.</p>

              <p>Identificación de la piel normal:</p>

              <p>La piel normal tiene buena circulación sanguínea, poros finos, textura lisa, aspecto
              hidratado, ausencia de impurezas como el fastidioso acné y no es propensa a la
              sensibilidad. A medida que crece una persona con piel normal pierde la hidratación de su
              piel y puede llegar a tener una piel un poco más seca.</p>

              <p>Cuidar la piel normal:</p>

              <p>Desmaquillarse es primordial por lo que debemos tener:</p>

              <ol>
                <li>Limpiadora facial para piel normal, aplicar todas las noches antes de dormir.</li>
                <li>Tónico es esencial en todo proceso desmaquillante.</li>
                <li>Hidratante para la noche, la piel normal también debe hidratarse esto es
                fundamental.</li>
                <li>Exfolia tu piel mínimo 1 vez por semana, quitara las células muertas para
                generar nuevas, esto ayuda a que luzca más hermosa.</li>
              </ol>

              <p>PIELES SECAS</p>

              <p>Una piel seca es por disminución de la producción de grasa natural llamada sebo, la
              piel seca carece de lípidos que ayudan a la hidratación y a la protección.</p>

              <p>Identificación de la piel seca:</p>

              <p>Una sensación de tirantez y piel áspera es una de las características fundamentales
              de la este tipo de piel, posible picor y se puede ver envejecida de manera prematura,
              además esta condición te hace propenso a la aparición de arrugas y manchas.</p>

              <p>Cuidar la piel seca:</p>

              <p>Para un buen cuidado debes usar:</p>

              <ol>
                <li>Crema leche limpiadora para piel seca.</li>
                <li>Tónico para piel seca sin alcohol esto es muy importante.</li>
                <li>La hidratación fundamental debes usar cremas con ácido hialurónico tanto de
                día como de noche.</li>
                <li>Usa mascarillas hidratantes de manera semanal.</li>
              </ol>

              <p>En ambos tipos de piel es importante el uso diario de protector solar así que por
              nada en el mundo lo olvides.</p>',

          'file' => '1_la-piel,-un-mundo-de-sorpresas..jpg',
          'author' => '“Dra. Estética” Adriana López Rivero - Médico Estético</p>',
          'source' => 'www.draestetica.com',

          'created_at' => time(),
          'updated_at' => time(),
        ]);

        $this->createIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-xblog_articles-tag_id',
            'xblog_articles',
            'tag_id',
            'xblog_tags',
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
            'fk-xblog_articles-tag_id',
            'xblog_articles'
        );

        $this->dropIndex(
            'idx-xblog_articles-tag_id',
            'xblog_articles'
        );

        $this->dropTable('xblog_articles');
        $this->dropTable('xblog_tags');
    }
}
