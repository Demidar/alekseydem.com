<?php

$this->title = 'Авторизация и регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>
<p>Авторизация регистрируется по всему сайту, независимо от конкретного
    проекта.</p>
<p>Создаю таблицу для хранения данных о пользователе c использованием миграции,
    предоставляемой yii2:</p>
<pre>
'id' => $this->primaryKey(),
'username' => $this->string(32)->notNull(),
'name' => $this->string(32),
'surname' => $this->string(32),
'auth_key' => $this->string(32)->notNull(),
'password_hash' => $this->string()->notNull(),
'password_reset_token' => $this->string(),
'status' => $this->integer()->defaultValue(10),
'email' => $this->string(),
'created_at' => $this->dateTime(),
</pre>
<p>СУБД - MySQL, кодировка - utf8mb4_general_ci</p>
<p>Создаю модель таблицы user, практически идентичную модели из Advanced приложения.</p>
<p>В качестве модели регистрации и авторизации использую модели SignupForm 
    и LoginForm соответственно.</p>
<p>Также присутствует страница, на которой размещены данные о аккаунте.</p>