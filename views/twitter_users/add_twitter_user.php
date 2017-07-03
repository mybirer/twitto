<?php ViewHelper::getHeader(); ?>
<?php 
    global $randomUser;
?>
<section class="content-header">
    <h1>
    <?php T::__("Add Twitter User"); ?>
    </h1>
    <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php T::__("Dashboard"); ?></a></li>
    <li><a href="index.php?controller=module&action=twitter_users"><i class="fa fa-files-o"></i> <?php T::__("Twitter User List"); ?></a></li>
    <li class="active"> <?php T::__("Add Twitter User"); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
    <div class="col-xs-12">
    <?php echo MessageHelper::getMessageHTML(); ?>
        <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php T::__("Search to Follow"); ?></h3>
            <div class="bs-callout bs-callout-default">
            <p>Twando can help you search for new users to follow below. Note that searching is rate-limited by Twitter. If you've set up the cron follow script (you really should have), the system will exclude users you were already following at the time of the last update. Please note that mass-following is quite a slow API process and the page may take several minutes to load after you select users to follow.</p>
            </div>
        </div>
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#search" aria-controls="search" role="tab" data-toggle="tab"><?php T::__("Search"); ?></a></li>
                    <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab"><?php T::__("Get Followers"); ?></a></li>
                    <li role="presentation"><a href="#following" aria-controls="following" role="tab" data-toggle="tab"><?php T::__("Get Following"); ?></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="search">
                    <form action="" method="post" id="searchForm">
                    <div class="form-group has-feedback">
                        <label><?php T::__('Search Type'); ?></label>
                        <select class="form-control" id="searchFormType" name="search_type">
                            <option value="user_based"><?php T::__('User based'); ?></option>
                            <option value="tweet_based"><?php T::__('Tweet based'); ?></option>
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <label><?php T::__('Search Term'); ?></label>
                        <input type="text" class="form-control" id="searchFormTerm" name="search_term" placeholder="<?php T::__('Type here search term'); ?>">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="hidden" name="twitter_id" value="<?php echo $randomUser['id']; ?>" />
                        <input type="hidden" name="operation_type" value="searchbyword" />
                        <input type="hidden" name="next_cursor" value="-1" />
                        <input type="hidden" name="previous_cursor" value="-1" />
                        <button type="submit" name="searchFormSubmit" class="btn btn-primary pull-right"><?php T::__("Search"); ?></button>
                        <div class="clr"></div>
                    </div>
                    <hr />
                    <div class="response-container"></div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="followers">
                    <form action="" method="post" id="getFollowersForm">
                    <div class="form-group has-feedback">
                        <label><?php T::__('Username'); ?></label>
                        <input type="text" class="form-control" id="getFollowersFormUsername" name="screen_name" placeholder="<?php T::__('Type here username for followers'); ?>">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="hidden" name="twitter_id" value="<?php echo $randomUser['id']; ?>" />
                        <input type="hidden" name="operation_type" value="getfollowers" />
                        <input type="hidden" name="next_cursor" value="-1" />
                        <input type="hidden" name="previous_cursor" value="-1" />
                        <button type="submit" name="getFollowersFormSubmit" class="btn btn-primary pull-right"><?php T::__("Get Followers"); ?></button>
                        <div class="clr"></div>
                    </div>
                    <hr />
                    <div class="response-container"></div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="following">
                    <form action="" method="post" id="getFriendsForm">
                    <div class="form-group has-feedback">
                        <label><?php T::__('Username'); ?></label>
                        <input type="text" class="form-control" id="getFriendsFormUsername" name="screen_name" placeholder="<?php T::__('Type here username for following'); ?>">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="hidden" name="twitter_id" value="<?php echo $randomUser['id']; ?>" />
                        <input type="hidden" name="operation_type" value="getfriends" />
                        <input type="hidden" name="next_cursor" value="-1" />
                        <input type="hidden" name="previous_cursor" value="-1" />
                        <button type="submit" name="getFriendsFormSubmit" class="btn btn-primary pull-right"><?php T::__("Get Followings"); ?></button>
                        <div class="clr"></div>
                    </div>
                    <hr />
                    <div class="response-container"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
        </div>
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">
$('#searchForm').on('submit',function(event){
    if(!$(this).find('#searchFormTerm').val()){
        alert("Please type search terms!");
        return false;
    }
	var postForm = $(this).serialize();
	ajaxFunction(event.currentTarget,'webservices/grab_users.php',postForm);
	return false;
});
$('#getFollowersForm').on('submit',function(event){
    if(!$(this).find('#getFollowersFormUsername').val()){
        alert("Please type username!");
        return false;
    }
	var postForm = $(this).serialize();
	ajaxFunction(event.currentTarget,'webservices/grab_users.php',postForm);
	return false;
});
$('#getFriendsForm').on('submit',function(event){
    if(!$(this).find('#getFriendsFormUsername').val()){
        alert("Please type username!");
        return false;
    }
	var postForm = $(this).serialize();
	ajaxFunction(event.currentTarget,'webservices/grab_users.php',postForm);
	return false;
});
function ajaxFunction(container,ajaxURL,ajaxDATA){
	var responseContainer = $(container).find('.response-container');
	responseContainer.html('<center><i class="fa fa-spinner fa-spin"></i> Veriler Çekiliyor...</center>');
	$.ajax({
		type      : 'POST',
		url       : ajaxURL,
		data      : ajaxDATA,
		dataType  : 'json',
		success   : function(data) {
			if (data.success==false || (!data.success)) {
                if(data.new_twitter_id && data.new_twitter_id.length>0){
                    $('#'+container.id).find('[name="twitter_id"]').val(data.new_twitter_id);
                }
                MessageHelper.setMessage("Error!","danger","ban",data.message);
                responseContainer.html(MessageHelper.getMessageHTML());
			}
			else {
                MessageHelper.setMessage("Success!","success","check",data.message);
                var output=MessageHelper.getMessageHTML();
                $('#'+container.id).find('[name="next_cursor"]').val(data.next_cursor);
                $('#'+container.id).find('[name="previous_cursor"]').val(data.previous_cursor);
				switch(container.id){ //special statements
					case "searchForm":
                        output+='<table class="table table-hover table-bordered">'+
                                    '<tr>'+
                                        '<th># <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',true);">Select All</a> <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',false);">Deselect All</a></th>'+
                                        '<th>Screen Name</th>'+
                                        '<th>Actual Name</th>'+
                                        '<th>Followers Count</th>'+
                                        '<th>Friends Count</th>'+
                                        '<th>Location</th>'+
                                        '<th>Created At</th>'+
                                        '<th>Last Updated</th>'+
                                        '<th>Twitter ID</th>'+
                                    '</tr>';
                        for(var i=0;i<data.returned_users.length;i++){
                            var obj=data.returned_users[i];
                            output+='<tr data-id="'+obj.id_str+'">'+
                                        '<td><label for="input_'+obj.id_str+'"><input id="input_'+obj.id_str+'" type="checkbox" name="chk_'+obj.id_str+'" class="tw_checkbox" /></label></td>'+
                                        '<td class="has-link"><a href="https://twitter.com/'+obj.screen_name+'" title="Twitter\'da Gör" target="_blank"><img src="'+obj.profile_image_url+'" class="profile-image" /></a>'+obj.screen_name+'</td>'+
                                        '<td class="has-link">'+obj.actual_name+'</td>'+
                                        '<td class="has-link">'+obj.followers_count+'</td>'+
                                        '<td class="has-link">'+obj.friends_count+'</td>'+
                                        '<td class="has-link">'+obj.location+'</td>'+
                                        '<td class="has-link">'+new Date(obj.created_at).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+new Date(obj.last_updated).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+obj.id_str+'</td>'+
                                    '</tr>';
                        }
                        output+='</table>';
					break;
                    case "getFollowersForm":
                        output+='<table class="table table-hover table-bordered">'+
                                    '<tr>'+
                                        '<th># <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',true);">Select All</a> <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',false);">Deselect All</a></th>'+
                                        '<th>Screen Name</th>'+
                                        '<th>Actual Name</th>'+
                                        '<th>Followers Count</th>'+
                                        '<th>Friends Count</th>'+
                                        '<th>Location</th>'+
                                        '<th>Created At</th>'+
                                        '<th>Last Updated</th>'+
                                        '<th>Twitter ID</th>'+
                                    '</tr>';
                        for(var i=0;i<data.returned_users.length;i++){
                            var obj=data.returned_users[i];
                            output+='<tr data-id="'+obj.id_str+'">'+
                                        '<td><label for="input_'+obj.id_str+'"><input id="input_'+obj.id_str+'" type="checkbox" name="chk_'+obj.id_str+'" class="tw_checkbox" /></label></td>'+
                                        '<td class="has-link"><a href="https://twitter.com/'+obj.screen_name+'" title="Twitter\'da Gör" target="_blank"><img src="'+obj.profile_image_url+'" class="profile-image" /></a>'+obj.screen_name+'</td>'+
                                        '<td class="has-link">'+obj.actual_name+'</td>'+
                                        '<td class="has-link">'+obj.followers_count+'</td>'+
                                        '<td class="has-link">'+obj.friends_count+'</td>'+
                                        '<td class="has-link">'+obj.location+'</td>'+
                                        '<td class="has-link">'+new Date(obj.created_at).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+new Date(obj.last_updated).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+obj.id_str+'</td>'+
                                    '</tr>';
                        }
                        output+='</table>';
                    break;
                    case "getFriendsForm":
                        output+='<table class="table table-hover table-bordered">'+
                                    '<tr>'+
                                        '<th># <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',true);">Select All</a> <a href="javascript:;" onclick="$(\'.tw_checkbox\').prop(\'checked\',false);">Deselect All</a></th>'+
                                        '<th>Screen Name</th>'+
                                        '<th>Actual Name</th>'+
                                        '<th>Followers Count</th>'+
                                        '<th>Friends Count</th>'+
                                        '<th>Location</th>'+
                                        '<th>Created At</th>'+
                                        '<th>Last Updated</th>'+
                                        '<th>Twitter ID</th>'+
                                    '</tr>';
                        for(var i=0;i<data.returned_users.length;i++){
                            var obj=data.returned_users[i];
                            output+='<tr data-id="'+obj.id_str+'">'+
                                        '<td><label for="input_'+obj.id_str+'"><input id="input_'+obj.id_str+'" type="checkbox" name="chk_'+obj.id_str+'" class="tw_checkbox" /></label></td>'+
                                        '<td class="has-link"><a href="https://twitter.com/'+obj.screen_name+'" title="Twitter\'da Gör" target="_blank"><img src="'+obj.profile_image_url+'" class="profile-image" /></a>'+obj.screen_name+'</td>'+
                                        '<td class="has-link">'+obj.actual_name+'</td>'+
                                        '<td class="has-link">'+obj.followers_count+'</td>'+
                                        '<td class="has-link">'+obj.friends_count+'</td>'+
                                        '<td class="has-link">'+obj.location+'</td>'+
                                        '<td class="has-link">'+new Date(obj.created_at).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+new Date(obj.last_updated).toLocaleString()+'</td>'+
                                        '<td class="has-link">'+obj.id_str+'</td>'+
                                    '</tr>';
                        }
                        output+='</table>';
                    break;
                }
                responseContainer.html(output);
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			var error_text=xhr.status+" "+thrownError;
            console.log(error_text);
            console.log(xhr.responseText);
		}
	});
}
</script>
<?php ViewHelper::getView('twitter_users','edit_twitter_users');?>
<?php ViewHelper::getFooter(); ?>

