<?php

namespace blog\controllers;

class DocumentationController extends \yii\web\Controller {
    
    public $layout = 'blog-documentation';
    
    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionCreateTables() {
        return $this->render('ch01-create-tables');
    }
    
    public function actionViewSite() {
        return $this->render('ch02-view-site');
    }
    
    public function actionComments() {
        return $this->render('ch03-comments');
    }
    
}