<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\TenancyHistory> $tenancyHistory
 */
?>
<?= $this->Html->css(['backendlibrary/fontawesome/all.min.css', 'backendlibrary/sb-admin-2.css', 'backendlibrary/custom.css']) ?>
<?= $this->Html->script(['backendlibrary/jquery.js', 'backendlibrary/bootstrap.bundle.min.js', 'backendlibrary/sb-admin-2.js', 'backendlibrary/add.js']) ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="tenancyHistories index content">

  <h3><?= __('Tenancy Histories') ?></h3>
  <?php
  $curr_id = $this->request->getAttribute('identity')->get('id');
  ?>

 <?= $this->Html->link(__(
            '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">view_list</i></span>
                 <span class="text">Go back to previous page</span>'
            ), ['controller'=>'Users','action' => 'Profile', $curr_id],['escape' => false, 'class'=>'btn btn-info btn-icon-split']) ?>  <br>
    <br>
  <div class="row">


    <?= $this->Form->create($tenancyHistory,['type'=>'file']) ?>
    <div class="row" >
      <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Letter of Recommendation (PDF Only)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php
                  echo $this->Form->control('rec_letter',['label'=> "" ,'type'=>'file', 'accept'=>'application/pdf']);
                  ?>
                  <br>
                </div>
              </div>
              <div class="col-auto">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Previous Addresses (PDF)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php


                  echo $this->Form->control('prev_add',['label'=> "" ,'type'=>'file', 'accept'=>'application/pdf']); ?>

                </div>
              </div>
              <div class="col-auto">
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-12 col-md-6 mb-4" style="margin-left:10px">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Save form</div>

                  <br>
                </div>
                <div class="col-auto">
                </div>
                <br>
                <?= $this->Form->button(__('Submit'), ['class'=>'form-control bg-light-custom border-0 small']) ?>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
