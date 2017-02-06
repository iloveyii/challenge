
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>

<?php

echo
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