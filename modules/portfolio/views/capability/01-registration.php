<?php
$this->title = 'Регистрация и авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>Составлена таблица пользователей:</p>
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
'created_at' => $this->integer(),
</pre>

<p>Составлена модель авторизации (LoginForm.php):</p>
<pre class="plain-code">
<?= htmlspecialchars(file_get_contents( Yii::getAlias('@app/models/LoginForm.php') )) ; ?>
</pre>

<p>Составлена модель регистрации (SignupForm.php):</p>
<pre class="plain-code">
<?= htmlspecialchars(file_get_contents( Yii::getAlias('@app/models/SignupForm.php') )) ; ?>
</pre>