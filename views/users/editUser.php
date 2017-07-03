<?php 
    global $obj;
?>
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="post" action="index.php?controller=module&action=users&do=add" id="editUserForm">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php T::__("Add User"); ?></h4>
        </div>
        <div class="modal-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab"><?php T::__("Account"); ?></a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php T::__("Profile"); ?></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="account">
                    <div class="form-group has-feedback">
                        <label><?php T::__('Full Name'); ?><span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editUserFormName" value="<?php echo $asdasd; ?>" name="editUserFormName">
                        <i class="fa fa-user form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Username'); ?><span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="editUserFormUsername" name="editUserFormUsername">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Email'); ?><span class="text-red">*</span></label>
                        <input type="email" class="form-control" id="editUserFormEmail" name="editUserFormEmail">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Password'); ?><span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="editUserFormPassword" name="editUserFormPassword">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Retype Password'); ?><span class="text-red">*</span></label>
                        <input type="password" class="form-control" id="editUserFormPassword2" name="editUserFormPassword2">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="form-group has-feedback">
                        <label><?php T::__('Country'); ?></label>
                        <input type="text" class="form-control" placeholder="<?php T::__('Country'); ?>" id="editUserFormCountry" name="editUserFormCountry">
                        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('City'); ?></label>
                        <input type="text" class="form-control" placeholder="<?php T::__('City'); ?>" id="editUserFormCity" name="editUserFormCity">
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Phone'); ?></label>
                        <input type="text" class="form-control" placeholder="<?php T::__('Phone'); ?>" id="editUserFormPhone" name="editUserFormPhone">
                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Picture'); ?></label>
                        <input type="text" class="form-control" placeholder="<?php T::__('Picture'); ?>" id="editUserFormPicture" name="editUserFormPicture">
                        <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('About'); ?></label>
                        <textarea class="form-control" placeholder="<?php T::__('About'); ?>" id="editUserFormAbout" name="editUserFormAbout"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-default pull-left" data-dismiss="modal"><?php T::__("Close"); ?></a>
            <button type="submit" name="editUserForm" class="btn btn-primary"><?php T::__("Save User"); ?></button>
        </div>
        </form>
    </div>
    </div>
</div>