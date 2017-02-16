<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use tuyakhov\youtube\EmbedWidget;

$this->title = 'Destinations ';
$this->params['breadcrumbs'][] = ['label'=>'Movies', 'url'=>['site/movies']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $this->registerCss('
        .newspaper {
            -webkit-columns: 100px 3; /* Chrome, Safari, Opera */
            -moz-columns: 100px 3; /* Firefox */
            columns: 100px 3;
        }
    ');
?>

<div class="newspaper">
    <?php foreach($trips as $trip): ?>
        <div class="list-group">
            <a href="<?=$trip->link?>">
                <img style="height:220px; width:100%" src="<?=$trip->image_link?>" class="img-thumbnail" />
            </a>
        </div>
    <?php endforeach; ?>
</div>