<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Carousel;

$this->title = 'Destinations ';
$this->params['breadcrumbs'][] = ['label'=>'Movies', 'url'=>['site/movies']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $this->registerCss('
        .newspaper {
            -webkit-columns: 100px 2; /* Chrome, Safari, Opera */
            -moz-columns: 100px 2; /* Firefox */
            columns: 100px 2;
        }
    ');

    $c = 0;
?>
<div class="newspaper">
    <?php foreach($trips as $trip): ?>
        <div class="list-group">
            <a href="<?=$trip->link?>">
                <?php
                $csvImages = '';
                $aImages = [];
                $aImages[] = [
                    'content' => "<img class='img-thumbnail' style='height:420px; width:100%' src='{$trip->image_link}'/>",
                    'caption' => "<h4>{$trip->title}</h4><p>This is the caption text</p>",
                    'options' => [],
                ];
                if(isset($trip->additional_image_link)) {
                    $images = explode(',', $trip->additional_image_link);

                    foreach($images as $image) {
                        $aImages[] = [
                            'content' => "<img class='img-thumbnail' style='height:420px; width:100%' src='{$image}'/>",
                            'caption' => "<h4>{$trip->title}</h4><p>This is the caption text</p>",
                            'options' => [],
                        ];
                    }
                }

                echo Carousel::widget([
                    'items' => $aImages,
                    'controls'=>count($aImages) > 1 ? false : false,
                    'showIndicators'=>true,
                ]);
                ?>
            </a>
        </div>
        <?php $c++; if($c > 9) break;?>
    <?php endforeach; ?>
</div>
