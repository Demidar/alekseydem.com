<?php

namespace app\rbac\blog;

use yii\rbac\Rule;

/**
 * Проверяем UserID на соответствие с пользователем, переданным через параметры
 */
class OwnPostRule extends Rule {
    
    public $name = 'blog@isAuthor';
    
    /**
     * 
     * @param type $user
     * @param type $item
     * @param type $params param 'article'
     * @return type
     */
    public function execute($user, $item, $params) {
        return isset($params['article']) ? $params['article']->created_by == $user : false;
    }
    
}