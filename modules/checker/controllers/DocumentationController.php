<?php

namespace checker\controllers;

class DocumentationController extends \yii\web\Controller {
    
    public $layout = 'checker-documentation';
    
    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionStructureApp() {
        return $this->render('ch1-structure-app');
    }
    
}