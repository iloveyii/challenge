<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use tuyakhov\youtube\EmbedWidget;

$this->title = 'Destinations ';
$this->params['breadcrumbs'][] = ['label'=>'Movies', 'url'=>['site/movies']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach($trips as $trip): ?>
    <div class="col-md-3 col-sm-6 list-group">
        <a href="<?=$trip->link?>">
            <img style="height:220px; width:100%" src="<?=$trip->image_link?>" class="img-thumbnail" />
        </a>
    </div>
<?php endforeach; ?>
