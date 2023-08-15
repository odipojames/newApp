<h1>Password Reset</h1>
<p>Click the link below to reset your password:</p>
<a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword', $token], ['_full' => true]) ?>">
    Reset Password
</a>
