<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {
    
    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        // лист разрешений, правил и ролей
        
        
        // пример имени разрешения - blog@updatePostPermission
        // пример имени разрешения, имеющее правило - blog@updateOwnPostRule
        // пример имени роли, имеющий одноименное разрешение - blog@updatePost
        // пример имени роли, имеющую ограниченное (т.е. с правилом) одноименное разрешение blog@updateOwnPost
        
/*******************************************************************************
        
        // используется для создания разрешении и ролей к ним
        // project - проект, который будет использовать данную роль
        // description - описание разрешения и роли
        $permissions = [
            'createPost' => [
                'project' => 'blog',
                'description' => 'Создание поста',
            ],
            'updatePost' => [
                'project' => 'blog',
                'description' => 'Изменение поста',
            ],
            'deletePost' => [
                'project' => 'blog',
                'description' => 'Удаление поста',
            ],
        ];
        // используется для создания разрешении, ограниченные указанным правилом, и ролей к ним
        // project - проект, который будет использовать данную роль
        // description - описание разрешения и роли
        // child - разрешение (не роль, а именно разрешение!), которое нужно ограничить. Оно должно находиться в одном и том же проекте.
        // rule - правило ограничения
        $rules = [
            'updateOwnPost' => [
                'project' => 'blog',
                'description' => 'Обновление собственных постов',
                'child' => 'updatePost',
                'rule' => new \app\rbac\blog\OwnPostRule,
            ],
            'deleteOwnPost' => [
                'project' => 'blog',
                'description' => 'Удаление собственных постов',
                'child' => 'deletePost',
                'rule' => new \app\rbac\blog\OwnPostRule,
            ],
        ];
        // используется для создания ролей с использованием других ролей
        // или для добавления разрешении к существующей роли
        // project - проект, который будет использовать данную роль
        // description - описание разрешения и роли
        // roles - роли, которые нужно привязать к данной роли
        $roles = [
            'author' => [
                'project' => 'blog',
                'description' => 'Автор: имеет возможность создания своих постов, а также изменения и добавления собственных',
                'childs' => [
                    'createPost',
                    'updateOwnPost',
                    'deleteOwnPost',
                ],
            ],
        ];
        
*******************************************************************************/

        // STEP 2
        $permissions = [
            'createComment' => [
                'project' => 'blog',
                'description' => 'Создание комментария',
            ],
            'updateComment' => [
                'project' => 'blog',
                'description' => 'Изменение комментария',
            ],
            'deleteComment' => [
                'project' => 'blog',
                'description' => 'Удаление комментария',
            ],
        ];
        
        $rules = [
            'updateOwnComment' => [
                'project' => 'blog',
                'description' => 'Обновление собственных комментариев',
                'child' => 'updateComment',
                'rule' => new \app\rbac\blog\OwnCommentRule,
            ],
            'deleteOwnComment' => [
                'project' => 'blog',
                'description' => 'Удаление собственных комментариев',
                'child' => 'deleteComment',
                'rule' => new \app\rbac\blog\OwnCommentRule,
            ],
        ];
        
        $roles = [
            'author' => [
                'project' => 'blog',
                'description' => 'Автор: имеет возможность создания своих постов, а также изменения и добавления собственных',
                'childs' => [
                    'createComment',
                    'updateOwnComment',
                    'deleteOwnComment',
                ],
            ],
        ];
        
        
        // создание администратора, если его нет
        if (!$auth->getRole('admin')) {
            $r = $auth->createRole('admin');
            $r->description = 'имеет все привилегии';
            $auth->add($r);
            $auth->assign($r, 8);
        }
        
        // создание разрешении из $permissions и ролей к ним
        foreach ($permissions as $name=>$permission) {
            $p = $auth->createPermission($permission['project'].'@'.$name.'Permission');
            $p->description = $permission['project'].'@Разрешение: '.$permission['description'];
            $auth->add($p);
            
            $r = $auth->createRole($permission['project'].'@'.$name);
            $r->description = $permission['project'].'@ '.$permission['description'];
            $auth->add($r);
            if (!$auth->hasChild($r, $p)) {
                $auth->addChild($r, $p);
            }
            
            // дать администратору созданную роль
            if (!$auth->hasChild($auth->getRole('admin'), $r)) {
                $auth->addChild($auth->getRole('admin'), $r);
            }
        }
        
        // создание разрешении из $rules, ограниченных правилом, и ролей к ним
        foreach ($rules as $name=>$rule) {
            
            if (!$auth->getRule($rule['rule']->name)) {
                $auth->add($rule['rule']);
            }
            
            $p = $auth->createPermission($rule['project'].'@'.$name.'Rule');
            $p->description = $rule['project'].'@Правило: '.$rule['description'];
            $p->ruleName = $rule['rule']->name;
            $auth->add($p);
            
            $auth->addChild($p, $auth->getPermission($rule['project'].'@'.$rule['child'].'Permission'));
            
            $r = $auth->createRole($rule['project'].'@'.$name);
            $r->description = $rule['project'].'@ '.$rule['description'];
            $auth->add($r);
            if (!$auth->hasChild($r, $p)) {
                $auth->addChild($r, $p);
            }
        }
        
        // Создание ролей из $roles, которые имеют другие, младшие роли
        // Если роль существует - то просто добавить к нему новые разрешения
        foreach ($roles as $name=>$role) {
            if (!$auth->getRole($role['project'].'@'.$name)) {
                $r = $auth->createRole($role['project'].'@'.$name);
                $r->description = $role['project'].'@ '.$role['description'];
                $auth->add($r);
            } else {
                $r = $auth->getRole($role['project'].'@'.$name);
            }
            foreach ($role['childs'] as $child) {
                if (!$auth->hasChild($r, $auth->getRole($role['project'].'@'.$child))) {
                    $auth->addChild($r, $auth->getRole($role['project'].'@'.$child));
                }
            }
            
            // дать администратору созданную роль
            if (!$auth->hasChild($auth->getRole('admin'), $r)) {
                $auth->addChild($auth->getRole('admin'), $r);
            }
        }
        
        /*
        // STEP 1 - Первые внесения
        
        // удалить все
        $auth->removeAll();
        
        // добавляем разрешение "blog@createPost"
        $createPostPerm = $auth->createPermission('blog@createPostPerm');
        $createPostPerm->description = 'Блог @ Разрешение: Создание поста';
        $auth->add($createPostPerm);
        
        // добавляем разрешение "blog@updatePost"
        $updatePostPerm = $auth->createPermission('blog@updatePostPerm');
        $updatePostPerm->description = 'Блог @ Разрешение: Изменение поста';
        $auth->add($updatePostPerm);
        
        // добавляем разрешение "blog@deletePost"
        $deletePostPerm = $auth->createPermission('blog@deletePostPerm');
        $deletePostPerm->description = 'Блог @ Разрешение: Удаление поста';
        $auth->add($deletePostPerm);
        
        // роли к вышесозданным разрешениям
        $createPost = $auth->createRole('blog@createPost');
        $createPost->description = 'Блог @ Создание поста';
        $auth->add($createPost);
        $auth->addChild($createPost, $child)
        
        // добавляем роль "blog@author" и даем роли разрешение "blog@createPost"
        $author = $auth->createRole('blog@author');
        $author->description = 'Блог @ Возможность создания постов';
        $auth->add($author);
        $auth->addChild($author, $createPost);
        
        // добавляем роль "admin" и даем роли разрешения "blog@updatePost"
        // и "blog@deletePost", а также все разрешения роли "blog@author"
        $admin = $auth->createRole('admin');
        $admin->description = 'Имеет все привилегии';
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $deletePost);
        $auth->addChild($admin, $author);
        
        // назначение ролей пользователям. 6 и 8 это IDs, возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 6); // Demidar
        $auth->assign($admin, 8); // Admin
        */
         
        
        /*
        //STEP 2 - добавление правила
        
        // правило, позволяющее пользователю управлять только собственными постами
        $rule = new \app\rbac\blog\OwnPostRule();
        $auth->add($rule);
        
        $updatePost = $auth->getPermission('blog@updatePost');
        $deletePost = $auth->getPermission('blog@deletePost');
        $author = $auth->getRole('blog@author');
        // привязываю правило "OwnPostRule" к разрешениям обновления и удаления постов
        $updateOwnPost = $auth->createPermission('blog@updateOwnPost');
        $updateOwnPost->description = 'Блог @ Обновление собственных постов';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);
        
        $deleteOwnPost = $auth->createPermission('blog@deleteOwnPost');
        $deleteOwnPost->description = 'Блог @ Удаление собственных постов';
        $deleteOwnPost->ruleName = $rule->name;
        $auth->add($deleteOwnPost);
        
        // эти правила будут использоваться из соответствующих разрешении
        $auth->addChild($updateOwnPost, $updatePost);
        $auth->addChild($deleteOwnPost, $deletePost);
        
        // разрешаем роли "blog@author" обновлять и удалять собственные посты
        $auth->addChild($author, $updateOwnPost);
        $auth->addChild($author, $deleteOwnPost);
        */
        echo 'Done';
    }
    
}