<?php

namespace blog\controllers;

use yii\web\Controller;
use blog\models\Articles;

/**
 * Default controller for the `blog` module
 */
class DefaultController extends Controller
{
    public $layout = 'blog-main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $articles = Articles::find()
                ->where(['status' => Articles::STATUS_ACTIVE])
                ->orderBy('created_at DESC')
                ->limit(3)
                ->all();
        
        $features = Articles::find()
                ->where(['status' => Articles::STATUS_FEATURES])
                ->orderBy('created_at DESC')
                ->limit(3)
                ->all();
        
        return $this->render('index', [
            'articles' => $articles,
            'features' => $features,
        ]);
    }
}
