<script>
    $(document).ready(function () {
        var tabToOpen = getUrlParameter('tab');

        if (tabToOpen) {
            $('#' + tabToOpen).tab('show');
        }
    });

    function getUrlParameter(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
</script>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="personalDetails" aria-selected="true">Personal Details</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Acadamic Qualifications</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
      <?= $this->Form->button(__('Save')) ?>
      <!-- <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?> -->
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

  </div>


  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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


