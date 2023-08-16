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

        <?= $this->Form->control('email', [
            'label' => false,
            'placeholder' => __('Email'),
            'append' => '<i class="fas fa-envelope"></i>',
            'required' => true, 
            'type' => 'email', 
            'error' => ['attributes' => ['class' => 'error-class']]
        ]) ?>
        
         <?= $this->Form->control(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>

        <?= $this->Form->end() ?>
    </div>
    <!-- /.login-card-body -->
</div>