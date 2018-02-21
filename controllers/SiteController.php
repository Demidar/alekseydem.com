<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = [
            'English' => [
                'list' => [
                    'Уверенно читаю техническую документацию',
                    'Хорошо воспринимаю речь на слух',
                ],
                'img' => 'img/labels/english.png',
            ],
            'PHP7' => [
                'list' => [
                    'Хорошо разбираюсь в ООП',
                    'Умею составлять регулярные выражения',
                ],
                'img' => 'img/labels/php.png',
            ],
            'Yii2 Framework' => [
                'list' => [
                    'Сайт построен на этом фреймворке',
                    'Использую миграции для работы с базой данных',
                    'Хорошо знаком с MVC паттерном',
                ],
                'img' => 'img/labels/yii.png',
            ],
            'MySQL' => [
                'list' => [
                    'Уверенно знаю и применяю язык запросов SQL',
                    'Имею опыт планирования небольших схем базы данных',
                ],
                'img' => 'img/labels/mysql.png',
            ],
            'Git' => [
                'list' => [
                    'Обладаю базовыми уверенными знаниями о работе с Git'
                ],
                'img' => 'img/labels/git.png',
            ],
            'JavaScript' => [
                'list' => [
                    'Хорошо знаю функциональное программирование на JS',
                ],
                'img' => 'img/labels/js.png',
            ],
            'JQuery' => [
                'list' => [
                    'Хорошо ориентируюсь в DOM с использованием jQuery',
                    'Могу управлять AJAX запросами',
                ],
                'img' => 'img/labels/jQuery.gif',
            ],
            'HTML5/CSS3' => [
                'list' => [
                    'Хорошо знаю HTML5 и CSS3',
                    'Разбираюсь в каскадности, псевдо-классах',
                    'Использую Emmet для быстрой верстки',
                ],
                'img' => 'img/labels/css.png',
            ],
            'Bootstrap 3' => [
                'list' => [
                    'Активно использую grid-сетку в своих проектах',
                    'Изменяю стили Bootstrap путем каскадности (наследования)',
                ],
                'img' => 'img/labels/bootstrap.png',
            ],
        ];
        
        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/portfolio/default/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionResume() {
        return $this->render('resume');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/portfolio/default/index']);
    }
    
    
    public function actionSignup() {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goBack();
                }
            }
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    public function actionAccount() {
        $model = User::findOne(Yii::$app->user->identity->id);
        
        return $this->render('account', [
            'model' => $model,
        ]);
    }
    
}
