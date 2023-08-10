<?php if($step===1):?>
  <div class="card card-primary card-outline">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active">Personal Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link">Acadamic Qualifications</a>
  </li>
</ul>
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
      <?= $this->Form->button(__('Save')) ?>
      <!-- <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?> -->
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

<?php elseif ($step===2):?>
  <div class="card card-primary card-outline">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#">Personal Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Acadamic Qualifications</a>
  </li>
</ul>
  <?= $this->Form->create($acadamic) ?>
  <div class="card-body">
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('course') ?>
    </div>
    <div class="col">
      <?= $this->Form->control('description',['type' => 'textarea', 'rows' => 5]) ?>
    </div>
  </div>
  <div class="form-row">
    <div class="col">
      <?= $this->Form->control('program') ?>
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
  <?php else: ?>
    <div class="h6">jjjjjj</div>

    <?php endif; ?>


