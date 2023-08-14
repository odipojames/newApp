<?php

use App\Model\Entity\User;
?>
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    <?= $this->Html->image('CakeLte./AdminLTE/dist/img/user2-160x160.jpg', ['class'=>'img-circle elevation-2', 'alt'=>'User Image']) ?>
  </div>
  <div class="info">
    <a href="#" class="d-block"><?=$this->HTML->link(__($this->request->getSession()->read('Auth')->username),["controller"=>'Profiles','action'=>'add']);?></a>
  </div>
</div>
