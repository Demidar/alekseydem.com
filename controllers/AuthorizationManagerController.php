<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class AuthorizationManagerController extends Controller {
    
    public $layout = 'auth-common';
    
    public function actionIndex() {
        $auth = Yii::$app->authManager;
        
        // get all users
        $users = User::find()->all();
        
        // initialize data
        $rolesAvailable = $auth->getRoles();
        $rolesNamesByUser = [];
        $permissionNamesByUser = [];
        $permissionsAvailable = $auth->getPermissions();
        
        // for each user, fill $rolesNames with name of roles assigned to user,
        // and fill $permissionsNames with name of permissions assigned to user
        foreach ($users as $user) {
            $rolesNames = [];
            $permissionsNames = [];
            $permissions = $auth->getPermissionsByUser($user->id);
            $roles = $auth->getRolesByUser($user->id);
            foreach ($permissions as $p) {
                $permissionsNames[] = $p->name;
            }
            foreach ($roles as $r) {
                $rolesNames[] = $r->name;
            }
            $permissionNamesByUser[$user->id] = $permissionsNames;
            $rolesNamesByUser[$user->id] = $rolesNames;
        }
        
        return $this->render('index', [
            'users' => $users, 
            'rolesAvailable' => $rolesAvailable, 
            'permissionsAvailable' => $permissionsAvailable, 
            'rolesNamesByUser' => $rolesNamesByUser,
            'permissionsNamesByUser' => $permissionNamesByUser,
        ]);
    }
    
    public function actionAddRole($userId, $roleName) {
        $auth = Yii::$app->authManager;
        
        if (!$auth->getAssignment($roleName, $userId)) {
            $auth->assign($auth->getRole($roleName), $userId);
        }
        
        return $this->redirect(['index']);
    }
    
    public function actionRemoveRole($userId, $roleName) {
        $auth = Yii::$app->authManager;
        
        if ($auth->getAssignment($roleName, $userId)) {
            $auth->revoke($auth->getRole($roleName), $userId);
        }
        
        return $this->redirect(['index']);
    }
    
    public function actionAddPermission($userId, $permissionName) {
        $auth = Yii::$app->authManager;
        
        if(!$auth->checkAccess($userId, $permissionName)) {
            $auth->assign($auth->getPermission($permissionName), $userId);
        }
        
        return $this->redirect(['index']);
    }
    
    public function actionRemovePermission($userId, $permissionName) {
        $auth = Yii::$app->authManager;
        if($auth->checkAccess($userId, $permissionName)) {
            $auth->revoke($auth->getPermission($permissionName), $userId);
        }
        
        return $this->redirect(['index']);
    }
    
}

