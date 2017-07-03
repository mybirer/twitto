<?php ViewHelper::getHeader(); ?>
<?php 
    global $objList;
    global $paginationHTML;
    global $params;
?>
<section class="content-header">
    <h1>
    <?php T::__("Twitter Users List"); ?>
    </h1>
    <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php T::__("Dashboard"); ?></a></li>
    <li class="active"> <?php T::__("Twitter Users List"); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
    <div class="col-xs-12">
    <?php echo MessageHelper::getMessageHTML(); ?>
        <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php T::__("Twitter Users List Table"); ?></h3>
            <div class="box-toolbox">
            <form id="search-form">
            <div class="input-group input-group-sm pull-left search-form">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php T::__("Search.."); ?>" <?php echo !empty(Functions::getUrlVariableValue("search_term")) ? "value='".htmlspecialchars(urldecode(Functions::getUrlVariableValue("search_term")))."'" : ""; ?> />
                <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
            </form>
            <a href="index.php?controller=module&action=twitter_users&do=add" class="btn btn-success pull-right">
                <i class="fa fa-plus"></i> <?php T::__("Add Twitter User"); ?>
            </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php T::__("Screenname"); ?></th>
                    <th><?php T::__("Actual Name"); ?></th>
                    <th><?php T::__("Followers Count"); ?></th>
                    <th><?php T::__("Friends Count"); ?></th>
                    <th><?php T::__("Location"); ?></th>
                    <th><?php T::__("Created At"); ?></th>
                    <th><?php T::__("Last Updated"); ?></th>
                    <th><?php T::__("Twitter ID"); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $i=$params['offset']+1; foreach($objList as $user): ?>
            <tr data-id="<?php  echo $user->twitter_id; ?>">
                <td><a data-toggle="tooltip" title="Detay Gör" class="text-red" href="index.php?controller=module&action=users&do=edit&id=<?php echo $user->twitter_id; ?>"><i class="fa fa-edit"></i></a></td>
                <td class="has-link"><a href="https://twitter.com/<?php echo $user->screen_name; ?>" title="Twitter'da Gör" target="_blank"><img src="<?php echo $user->profile_image_url; ?>" class="profile-image" /></a><?php echo $user->screen_name; ?></td>
                <td class="has-link"><?php echo $user->actual_name; ?></td>
                <td class="has-link"><?php echo $user->followers_count; ?></td>
                <td class="has-link"><?php echo $user->friends_count; ?></td>
                <td class="has-link"><?php echo $user->location; ?></td>
                <td class="has-link"><?php echo $user->created_at; ?></td>
                <td class="has-link"><?php echo $user->last_updated; ?></td>
                <td class="has-link"><?php echo $user->twitter_id; ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody></table>
        </div>
        <div class="box-footer clearfix">
            <div class="table-length dataTables_length pull-left">
                <label><?php T::__("Show:"); ?>
                    <select name="limit" class="form-control input-sm">
                    <option value="10" <?php echo Functions::getUrlVariableValue("limit")=="10" ? "selected" : ""; ?>>10</option>
                    <option value="25" <?php echo Functions::getUrlVariableValue("limit")=="25" ? "selected" : ""; ?>>25</option>
                    <option value="50" <?php echo Functions::getUrlVariableValue("limit")=="50" ? "selected" : ""; ?>>50</option>
                    <option value="100" <?php echo Functions::getUrlVariableValue("limit")=="100" ? "selected" : ""; ?>>100</option>
                    </select>
                </label>
            </div>
            <?php
            echo $paginationHTML;
            ?>

        </div>
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">
$('select[name="limit"]').on("change",function(){
    var hash = window.location.search;
    var tt=hash.split("&");
    var route="";
    $.each(tt,function(i,t){
        var q=t.split("=");
        if(q[0]!="limit" && q[0]!="page"){
            route+=t+"&";
        }
    });
    route+="limit="+encodeURIComponent($(this).val());
    location.href=route;
})
$('#search-form').on("submit",function(){
    var hash = window.location.search;
    var tt=hash.split("&");
    var route="";
    $.each(tt,function(i,t){
        var q=t.split("=");
        if(q[0]!="search_term" && q[0]!="page"){
            route+=t+"&";
        }
    });
    route+="search_term="+encodeURIComponent($('input[name="table_search"]').val());
    location.href=route;
    return false;
});
$('button[data-toggle="openModal"]').on('click',function(){
    $($(this).data("target")).modal('show');
    return false;
});
</script>
<?php ViewHelper::getView('twitter_users','edit_twitter_users');?>
<?php ViewHelper::getFooter(); ?>