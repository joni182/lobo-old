<?php

namespace app\assets;

use yii\web\AssetBundle;

class SortableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sortable.css',
    ];
    public $js = [
        'js/sortable.js',
        'js/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
