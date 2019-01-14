<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Play Now';
?>

<div class="challenge-index box">
    <?php foreach ($dataProviders as $name => $dataProvider) :  ?>
        <h1><?= Html::encode($name) ?></h1>

        <?php echo $this->render('_playnow', ['dataProvider' => $dataProvider])?>

    <?php endforeach; ?>
</div>
