<?php

namespace app\assets;

use yii\web\AssetBundle;

class BlogAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/blog.css',
        'css/summernote.css',
    ];
    public $js = [
        'js/summernote.js',
        'lang/summernote-ru-RU.js',
        'js/blog/main.js',
    ];
    public $depends = [
        'app\assets\PortfolioAsset',
    ];
    
}