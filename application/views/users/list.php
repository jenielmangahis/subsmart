<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Employees</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Employees</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php ////if (hasPermissions('users_add')): ?>
                                    <a href="<?php echo url('users/add') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Employee
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">List of Employees</h4>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Last Login</th>
                                            <th>Status</th>
                                            <th>App Access</th>
                                            <th>Web Access</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead> 
                                        <tbody>
                                        <?php foreach ($users as $row): ?>
                                            <tr>
                                                <td width="60"><?php echo $row->id ?></td>
                                                <td width="50" class="text-center">
                                                    <img src="<?php echo userProfileImage($row->id) ?>" width="40"
                                                         height="40" alt="" class="img-avtar">

                                                     <?php    
                                                            if($row->profile_img <> 0){
                                                                $avatar = $row->profile_img .".".$row->img_type;
                                                            }else{
                                                                $avatar = "default.png";
                                                            }
                                                     ?>       

                                                    <img src="<?php echo base_url('uploads/users/'.$avatar);?>" width="40" height="40" alt="" class="img-avatar" />
                                                </td>
                                                <td>
                                                    <?php echo $row->FName.' '.$row->LName ?>
                                                </td>
                                                <td><?php echo $row->email ?></td>
                                                <td><?php echo $row->password_plain ?></td>
                                                <td><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                                                <td><?php echo ($row->last_login != '0000-00-00 00:00:00') ? date(setting('date_format'), strtotime($row->last_login)) : 'No Record' ?></td>
                                                <td>
                                                    <?php //if (logged('id') !== $row->id): ?>
                                                        <!-- <input type="checkbox" class="js-switch"
                                                               onchange="updateUserStatus('<?php //echo $row->id ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' ?> /> -->
                                                        <?php if( $row->status == 1 ): ?>
                                                            <span>Active</span>
                                                        <?php else: ?>
                                                            <span>Inactive</span>
                                                        <?php endif; ?>
                                                    <?php //endif ?>
                                                </td>
                                                <td class="text-center"><span class="fa fa-lg fa-mobile"></span></td>
                                                <td class="text-center"><span class="fa fa-lg fa-desktop"></span></td>
                                                <td>
                                                    <?php //if (hasPermissions('users_edit')): ?>
                                                        <a href="<?php echo url('users/edit/' . $row->id) ?>"
                                                           class="btn btn-sm btn-default" title="Edit User"
                                                           data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                    <?php //endif ?>
                                                    <?php //if (hasPermissions('users_view')): ?>
                                                        <a href="<?php echo url('users/view/' . $row->id) ?>"
                                                           class="btn btn-sm btn-default" title="View User"
                                                           data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                                    <?php //endif ?>
                                                    <?php //if (hasPermissions('users_delete')): ?>
                                                        <?php if ($row->id != 1 && logged('id') != $row->id): ?>
                                                            <a href="<?php echo url('users/delete/' . $row->id) ?>"
                                                               class="btn btn-sm btn-default"
                                                               onclick="return confirm('Do you really want to delete this user ?')"
                                                               title="Delete User" data-toggle="tooltip"><i
                                                                        class="fa fa-trash"></i></a>
                                                        <?php else: ?>
                                                            <a href="#" class="btn btn-sm btn-default"
                                                               title="You cannot Delete this User" data-toggle="tooltip"
                                                               disabled><i class="fa fa-trash"></i></a>
                                                        <?php endif ?>
                                                    <?php //endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    //$('#dataTable1').DataTable();

    $(document).ready(function () {
        $('#dataTable1').DataTable();
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));


    elems.forEach(function (html) {

        var switchery = new Switchery(html, {size: 'small'});

    });


    window.updateUserStatus = (id, status) => {

        $.get('<?php echo url('users/change_status') ?>/' + id, {

            status: status

        }, (data, status) => {

            if (data == 'done') {

                // code

            } else {

                alert('Unable to change Status ! Try Again');

            }

        })

    }


</script>