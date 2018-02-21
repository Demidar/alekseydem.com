<?php

namespace app\assets;

use yii\web\AssetBundle;

class DocumentationAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/documentation.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'app\assets\PortfolioAsset',
    ];
    
}