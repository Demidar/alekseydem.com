<?php

namespace app\assets;

use yii\web\AssetBundle;

class CheckerdbAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/checker.css',
        'css/checkerdb.css'
    ];
    public $js = [
        //'js/checker/load.js',
        //'js/checker/text/tests.js',
        'js/checkerdb/main.js',
    ];
    public $depends = [
        'app\assets\PortfolioAsset',
    ];
    
}