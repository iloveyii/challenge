<?php

use yii\db\Migration;

class m170127_202921_create_table_submission extends Migration
{
    public function up()
    {
        $this->createTable('submission', [
            'id' => $this->primaryKey(),
            'challenge_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'code' => $this->string(300),
            'score' => $this->integer(2),
        ]);
    }

    public function down()
    {
        $this->dropTable('submission');
    }
}
