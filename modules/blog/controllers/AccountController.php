<?php

namespace blog\controllers;

use Yii;
use blog\models\Articles;
use blog\models\ArticlesComments;

class AccountController extends \yii\web\Controller {
    
    public $layout = 'blog-main';
    
    public function actionIndex() {
        $articles = Articles::find()
                ->where(['created_by' => Yii::$app->user->identity->id, 'status' => Articles::STATUS_ACTIVE])
                ->limit(3)
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        $comments = ArticlesComments::find()
                ->where(['created_by' => Yii::$app->user->identity->id, 'status' => ArticlesComments::STATUS_ACTIVE])
                ->limit(3)
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        return $this->render('index', [
            'articles' => $articles,
            'comments' => $comments,
        ]);
        
    }
    
    public function actionPosts() {
        $articles = Articles::find()->where(['created_by' => Yii::$app->user->identity->id])->orderBy(['created_at' => SORT_DESC])->all();
        
        return $this->render('posts', [
            'articles' => $articles,
        ]);
    }
    
    public function actionComments() {
        $comments = ArticlesComments::find()
                ->where(['created_by' => Yii::$app->user->identity->id, 'status' => ArticlesComments::STATUS_ACTIVE])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        
        return $this->render('comments', [
            'comments' => $comments,
        ]);
    }
    
}