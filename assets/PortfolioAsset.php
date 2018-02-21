<?php

namespace app\assets;

use yii\web\AssetBundle;

class PortfolioAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/portfolio.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'app\assets\CommonAsset',
    ];
    
}