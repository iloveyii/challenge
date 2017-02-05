<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

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
                  'header' => 'Sub Category',
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
                [
                    'header' => 'Challenge',
                    'value' => 'challenge_title'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $data) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                Url::to(['challenge/view', 'id'=>$data['id']]), [
                                'title' => Yii::t('app', 'View Challenge'),
                            ]);
                        }
                    ]
                ],
          ],
        ]); ?>

    <?php endforeach; ?>
</div>
