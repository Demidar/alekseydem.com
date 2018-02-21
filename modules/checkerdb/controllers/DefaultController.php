<?php

namespace checkerdb\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `checkerdb` module
 */
class DefaultController extends Controller
{
    public $layout = 'checkerdb-main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = (new \yii\mongodb\Query())->from('tests')->limit(5)->all();
        return $this->render('index', [
            'model' => $model
        ]);
    }
}
