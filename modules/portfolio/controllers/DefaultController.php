<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;

/**
 * Default controller for the `portfolio` module
 */
class DefaultController extends Controller
{
    public $layout = 'portfolio-common';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionProjects() {
        return $this->render('projects');
    }
}
