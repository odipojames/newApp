<?php

/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><?= __('reset your account password') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('password', [
            'label' => 'new password',
            'append' => '<i class="fas fa-lock"></i>',
            'required' => true, 
            'type' => 'password',
            'minlength' => 4, 
            'error' => ['attributes' => ['class' => 'error-class','style' => 'color: red; font-size: 14px; margin-top: 5px; display: block;']], 
        ]) ?>

        <?= $this->Form->control('confirm_password', [
            'label' => 'confirm new password',
            'append' => '<i class="fas fa-lock"></i>',
            'required' => true, 
            'type' => 'password', 
            'minlength' => 4,
            'error' => ['attributes' => ['class' => 'error-class','style' => 'color: red; font-size: 14px; margin-top: 5px; display: block;']],
        ]) ?>




        <?= $this->Form->control(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>

        <?= $this->Form->end() ?>
    </div>
    <!-- /.login-card-body -->
</div>