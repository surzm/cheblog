<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta property="og:url" content="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
    <?php if(isset(Yii::$app->params['og_meta'])) { ?>
        <meta property="og:title" content="<?=Yii::$app->params['og_meta']['title']?>">
        <meta property="og:description" content="<?=strip_tags(Yii::$app->params['og_meta']['description'])?>">
        <meta property="og:image" content="<?=Yii::$app->params['og_meta']['img']?>">
    <?php } ?>
    <meta property="og:site_name" content="Чевостик">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_EN">
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('header') ?>

        <?= $content ?>

<footer class="page-footer">
  <?=$this->render('footer')?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
