<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <!-- card-header -->
        <div class="card-header">
            <h3 class="card-title pull-left"> <?= $this->lang->line('office_events') ?></h3>
            <div class="pull-right">
               
            </div>
        </div>
        <!-- / card-header -->
        <!-- card-body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">

                    <h3 class="card-title">🎉  <?= $this->lang->line('upcoming_birthdays') ?>  🎂</h3>

                    <div class="card-tools">
                      <!-- <span class="badge badge-danger">8 New Members</span> -->
                      <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        <?php if (!empty($birthdays)) { ?>
                            <?php foreach ($birthdays as $obj) { ?>
                                <li style="text-align: center; list-style: none; display: inline-block; width: 120px;">
                                <?php if (!empty($obj['photo'])) { ?>
                                    <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; margin: auto;">
                                        <img src="<?= get_avatar_url($obj['photo']) ?>" 
                                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                                    </div>
                                <?php } ?>
                                    <a class="users-list-name" href="#"><?= $obj['name']; ?></a>
                                    <span class="users-list-date"><?= date("d M", strtotime($obj['dob'])); ?></span>
                                </li>
                            <?php } ?>
                        <?php } else { ?>
                            <p> <?= $this->lang->line('no_upcoming_birthdays') ?>  🎂</p>
                        <?php } ?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <!-- <div class="card-footer text-center">
                    <a href="javascript::">View All Users</a>
                  </div> -->
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
             <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">

                    <h3 class="card-title">🎉  <?= $this->lang->line('upcoming_work_anniversary') ?>  🎂</h3>

                    <div class="card-tools">
                      <!-- <span class="badge badge-danger">8 New Members</span> -->
                      <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        <?php if (!empty($work_anniversary)) { ?>
                                <?php foreach ($work_anniversary as $obj) { ?>
                                    <li style="text-align: center; list-style: none; display: inline-block; width: 120px;">
                                        <?php if (!empty($obj['photo'])) { ?>
                                            <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; margin: auto;">
                                                <img src="<?php echo base_url() . $obj['photo']; ?>"
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" />
                                            </div>
                                        <?php } ?>
                                        <a class="users-list-name" href="#"><?= $obj['name']; ?></a>
                                        <span class="users-list-date"><?= date("d M", strtotime($obj['dob'])); ?></span>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <p> <?= $this->lang->line('no_upcoming_anniversaries') ?>  🎂</p>
                            <?php } ?>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer text-center">
                                <a href="javascript::">View All Users</a>
                              </div> -->
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
        </div>
        </div>
    </div>
</div>

<!-- <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script> -->

