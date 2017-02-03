<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Play Now';
?>

<div class="challenge-index">
    <?php foreach ($dataProviders as $name => $dataProvider) :  ?>
        <h1><?= Html::encode($name) ?></h1>
        <?=
          GridView::widget([
            'dataProvider' => $dataProvider,
              'layout'=>"{items}",
              'columns' => [
                [
                  'attribute' => 'sub_category_id',
                  'value' => function($data) {
                    return  $data['sub_category_name']; //$model->getSubcategoryName();
                  }
                ],
                [
                  'header' => 'Ending Time',
                  'value' => function($data){
                    return '<span class="glyphicon glyphicon-download"></span>  ' . $data['date_stop'] ;
                  },
                  'format' => 'html'
                ],
                'challenge_title',
          ],
        ]); ?>

    <?php endforeach; ?>
</div>
