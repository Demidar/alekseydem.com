<?php

namespace blog\controllers;

use Yii;
use yii\filters\AccessControl;
use blog\models\Articles;
use blog\models\LeaveCommentForm;
use blog\models\ArticlesComments;
use yii\data\ActiveDataProvider;

class ArticleController extends \yii\web\Controller {

    public $layout = 'blog-main';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['blog@author'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['blog@author'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['blog@author'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionArticle($id = null) {

        $leaveCommentForm = new LeaveCommentForm();

        // Если загружается новый комментарий, проверить и записать
        if ($leaveCommentForm->load(Yii::$app->request->post()) && $leaveCommentForm->leaveComment()) {
            return $this->goBack();
        }

        // если указан номер статьи
        if ($id) {
            $article = Articles::findOne($id);
            $leaveComment = new ArticlesComments();
            
            $query = ArticlesComments::find()->where(['id_article' => $article->id, 'status' => ArticlesComments::STATUS_ACTIVE]);
            
            $provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 5,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],
            ]);
            
            $comments = $provider->getModels();
            
            return $this->render('article', [
                        'article' => $article,
                        'comments' => $comments,
                        'commentsPagination' => $provider->pagination,
                        'leaveComment' => $leaveComment,
                        'leaveCommentForm' => $leaveCommentForm,
            ]);
        } else {
            return $this->redirect('articles');
        }
    }

    public function actionIndex() {
        $query = Articles::find()->where(['status' => Articles::STATUS_ACTIVE]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        $articles = $provider->getModels();

        return $this->render('index', [
                    'articles' => $articles,
                    'pagination' => $provider->pagination,
        ]);
    }
    
    public function actionCreate() {
        $model = new Articles();
        if (Yii::$app->user->can('blog@createPostPermission')) {
            if ($model->load(Yii::$app->request->post())) {
                $model->save();
                return $this->redirect(['article', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    public function actionUpdate($id) {
        $article = Articles::findOne($id);
        if (Yii::$app->user->can('blog@updatePostPermission', ['article' => $article])) {
            if ($article->load(Yii::$app->request->post()) && $article->save()) {
                return $this->redirect(['article', 'id' => $article->id]);
            } else {
                return $this->render('update', [
                    'model' => $article,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'У вас нет доступа к данной операции');
            return $this->redirect('index');
        }
    }
    
    public function actionDelete($id) {
        $article = Articles::findOne($id);
        if (Yii::$app->user->can('blog@deletePostPermission', ['article' => $article])) {
            $article->status = Articles::STATUS_DELETED;
            $article->save();
            return $this->redirect('index');
        } else {
            Yii::$app->session->setFlash('error', 'У вас нет доступа к данной операции');
            return $this->redirect('index');
        }
    }
    
    public function actionCommentUpdate($id) {
        $comment = ArticlesComments::findOne($id);
        if (Yii::$app->user->can('blog@updateCommentPermission', ['comment' => $comment])) {
            if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
                return $this->redirect(['article', 'id' => $comment->id_article]);
            } else {
                return $this->render('update-comment', [
                    'model' => $comment,
                ]);
            }
        }
    }
    
    public function actionCommentDelete($id) {
        $comment = ArticlesComments::findOne($id);
        if (Yii::$app->user->can('blog@deleteCommentPermission', ['comment' => $comment])) {
            $comment->status = ArticlesComments::STATUS_DELETED;
            $comment->save();
            return $this->redirect(['article', 'id' => $comment->id_article]);
        }
    }

}
