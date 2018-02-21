<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;

class CapabilityController extends Controller {
    
    public $layout = 'portfolio-capability';
    
    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionRegistration() {
        return $this->render('01-registration');
    }
    
}