<?php

namespace app\modules\portfolio\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class ChronicleController extends Controller {
    
    public $layout = 'portfolio-chronicle';
/*    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->session->setFlash('Deny access', 'У вас нет доступа к данной странице');
                    return $this->goBack();
                },
            ],
        ];
    }
*/   
    public function actionIndex() {
        return $this->render('1-index');
    }
    
    public function actionPlanning() {
        return $this->render('2-planning');
    }
    
    public function actionApplicationConfiguration() {
        return $this->render('3-application-configuration');
    }
    
    public function actionCreateFoundation() {
        return $this->render('4-create-foundation');
    }
    
    public function actionCreateTemplateAndView() {
        return $this->render('5-create-template-and-view');
    }
    
    public function actionModulePortfolio() {
        return $this->render('6-module-portfolio');
    }
    
    public function actionModuleBlog() {
        return $this->render('7-module-blog');
    }
    
    public function actionAuthAndReg() {
        return $this->render('8-auth-and-reg');
    }
    
    public function actionProjectBlog() {
        return $this->render('9-project-blog');
    }
    
    public function actionBlogCreateTables() {
        return $this->render('9-ch01-create-tables');
    }
    
    public function actionBlogViewSite() {
        return $this->render('9-ch02-view-site');
    }
    
    public function actionBlogComments() {
        return $this->render('9-ch03-comments');
    }
    
    public function actionProjectChecker() {
        return $this->render('10-ch01-project-checker');
    }
    
    public function actionProjectCheckerdb() {
        return $this->render('11-ch01-project-checkerdb');
    }
    
    public function actionCheckerdbPreparingMongodb() {
        return $this->render('11-ch02-preparing-mongodb');
    }
    
}
