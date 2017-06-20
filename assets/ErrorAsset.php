<?php
/**
 * Created by PhpStorm.
 * User: kukushkina
 * Date: 19.06.17
 * Time: 15:59
 */

namespace app\assets;

use yii\web\AssetBundle;


class ErrorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'nassets/styles/error40.css',
    ];
    public $js = [
        'nassets/js/main.js',
        'nassets/js/plugin.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}