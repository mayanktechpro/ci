<?php 
  $this->view('templates/header');
  $this->view('templates/nav');
?>
<div id="page-wrapper" style="min-height: 288px;">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Manage Users</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Users
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">

              <?php if (count($users)) { ?>
                <table class="table table-striped table-bordered table-hover" id="dataTables-admin">
                  <thead>
                    <tr title="Click columns to sort">
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $user) { ?>
                      <tr>
                        <td><?=$user->name?></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->email?></td>
                        <td>
                          <a href="<?=site_url('user/edit/'.$user->id)?>">
                          <i class="fa fa-pencil-square-o" title="Edit User Details"></i></a>&nbsp;&nbsp;
                          <a href="#" id="delete-user" delete_id="<?=$user->id?>" delete_url="<?=site_url('user/delete/')?>">
                          <i class="fa fa-trash-o" title="Delete page"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              <?php } else echo '<h2>No Users Available.</h2>'; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
</div>
<?php
  $this->view('templates/footer');
?>