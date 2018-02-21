<?php

namespace checker\controllers;

use yii\web\Controller;

/**
 * Default controller for the `checker` module
 */
class DefaultController extends Controller
{
    public $layout = 'checker-main';
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('tests');
    }
}
