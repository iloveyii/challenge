<?php

use yii\db\Migration;

class m170127_202852_create_table_sub_category extends Migration
{
    public function up()
    {
        $this->createTable('sub_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'category_id' => $this->integer(11),
            'evaluation_class' => $this->string(70),
        ]);
    }

    public function down()
    {
        $this->dropTable('sub_category');
    }
}
