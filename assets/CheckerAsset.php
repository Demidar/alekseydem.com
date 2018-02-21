<?php

namespace app\assets;

use yii\web\AssetBundle;

class CheckerAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/checker.css',
    ];
    public $js = [
        'js/checker/load.js',
        'js/checker/text/tests.js',
    ];
    public $depends = [
        'app\assets\PortfolioAsset',
    ];
    
}