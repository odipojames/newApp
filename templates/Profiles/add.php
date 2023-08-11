<?php
$tab_content1_status = 'active';
$tab_selected1_status = 'true';
$tab_show1_status = 'active show';

$tab_content2_status = '';
$tab_selected2_status = 'false';
$tab_show2_status = '';

#get tabe from query string
$queryParameters = $this->getRequest()->getQueryParams();

#chek if it exists and set tab visited active
if(isset($queryParameters['tab'])){

  if ($queryParameters['tab'] == 'content1') {
    $tab_content1_status = 'active';
    $tab_selected1_status = 'true';
    $tab_show1_status = 'active show';
  
    $tab_content2_status = '';
    $tab_selected2_status = 'false';
    $tab_show2_status = '';
  
  } elseif ($queryParameters['tab'] == 'content2') {
    $tab_content1_status = '';
    $tab_selected1_status = 'false';
    $tab_show1_status = '';
  
    $tab_content2_status = 'active';
    $tab_selected2_status = 'true';
    $tab_show2_status = 'active show';
  }
  
}



?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link <?= $tab_content1_status ?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="personalDetails" aria-selected="<?= $tab_selected1_status?>" >Personal Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link <?= $tab_content2_status ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="<?= $tab_selected2_status?>" >Acadamic Qualifications</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade <?= $tab_show1_status ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="card card-primary card-outline">
  <?= $this->Form->create($details) ?>
  
  <div class="card-body">
  
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('first_name') ?>
    </div>
    <div class="col">
      <?= $this->Form->control('last_name') ?>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('id_number') ?>
    </div>
    <div class="col">
      <?= $this->Form->control('phone_number') ?>
    </div>
  </div>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save and Continue')) ?>
      <!-- <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?> -->
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

  </div>


  <div class="tab-pane fade <?= $tab_show2_status ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <div class="card card-primary card-outline">
  <?= $this->Form->create($acadamic) ?>
  <div class="card-body">
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('course') ?>
    </div>
    <div class="col">
      <?= $this->Form->control('descricption',['type' => 'textarea', 'rows' => 5]) ?>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('program', ['options' => $programs]) ?>
    </div>
    <div class="col">
      <!-- <?= $this->Form->control('phone_number') ?> -->
    </div>
  </div>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <!-- <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?> -->
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
  </div>

</div>


