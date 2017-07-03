<?php
define('_MYINC','minyy');
require_once('../config.php');
require_once('../connection.php');
require_once('../helpers/twitter_helper.php');
require_once('../helpers/functions_helper.php');

require_once('../models/model_template.php');
require_once('../models/twitter_users_model.php');
require_once('../models/authed_users_model.php');

require_once('../helpers/twitteroauth/twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

set_time_limit(0);
$new_twitter_id=array("id"=>"");
$_OBJ=array();
$form_data = array('success'=>false,'message'=>'Bad Query'); //Pass back the data to `form.php`
if(isset($_GET) && !empty($_GET)){
	$_OBJ=$_GET;
}
else if(isset($_POST) && !empty($_POST)){
	$_OBJ=$_POST;
}
else if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){
	$_OBJ=json_decode($GLOBALS['HTTP_RAW_POST_DATA'],TRUE);
}
else if(isset($HTTP_RAW_POST_DATA)){
	$_OBJ=json_decode($HTTP_RAW_POST_DATA);
}
foreach($_OBJ as $key=>$item){
	$$key=Functions::clearString($item,false);
}
/*
operation_type searchbyword getfollowers getfriends
search_term	ahmet
search_type	1
screen_name twitterdev
twitter_id	1910130146
*/
if(isset($operation_type)){
	switch($operation_type){
		case 'searchbyword':
			if(isset($search_term) && isset($search_type) && isset($twitter_id)){
				//Get twitter details and make connection
				$app_credentials = TwitterHelper::getAppCredentials();
				$authed_user = AuthedUsers::getObj($twitter_id);
				$connection = new TwitterOAuth($app_credentials['consumer_key'], $app_credentials['consumer_secret'], $authed_user->oauth_token, $authed_user->oauth_token_secret);
				$returned_users = array();
				switch($search_type){
					case "tweet_based":
						/*
						Fixed in version 0.5 for Twitter API 1.1
						*/
						//Get Results
						$content = $connection->get('search/tweets',array('q' => $search_term,'count' => TWITTER_TWEET_SEARCH_PP));
						if($connection->getLastHttpCode() == 200){
							if ($content->statuses) {
								foreach ($content->statuses as $user_row) {
									//filtreyi buraya basacağız
									$returned_users[] = array("screen_name" => $user_row->user->screen_name,
									"actual_name" => $user_row->user->name,
									"followers_count" => $user_row->user->followers_count,
									"friends_count" => $user_row->user->friends_count,
									"location" => $user_row->user->location,
									"created_at" => $user_row->user->created_at,
									"last_updated" => $user_row->created_at,
									"id_str" => $user_row->user->id_str,
									"profile_image_url" => $user_row->user->profile_image_url_https,
									"protected" => $user_row->user->protected,
									"lang" => $user_row->user->lang,
									"statuses_count" => $user_row->user->statuses_count,
									"source" => $user_row->source,
									"user_detailed_params" => json_encode($user_row));
								}
								$form_data['success']=true;
								$form_data['message']="Success! Data fetched from twitter";
							}
						}
						else{
							$form_data['message']="Error! Can't reach twitter with current credentials";
						}
						$form_data['returned_users_insert_status']=TwitterUsers::bulkInsert($returned_users);
						$form_data['returned_users']=$returned_users;
					break;
					case "user_based":
						//Loop through results
						for ($i = 1; $i<=5; $i++) {
							$content = $connection->get('users/search',array('q' => $search_term,'count' => TWITTER_USER_SEARCH_PP,'page'=>$i));
							if($connection->getLastHttpCode() == 200){
								if ($content) {
									foreach ($content as $user_row) {
										//filtreyi buraya basacağız
										$returned_users[] = array("screen_name" => $user_row->screen_name,
										"actual_name" => $user_row->name,
										"followers_count" => $user_row->followers_count,
										"friends_count" => $user_row->friends_count,
										"location" => $user_row->location,
										"created_at" => $user_row->created_at,
										"last_updated" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->created_at : "",
										"id_str" => $user_row->id_str,
										"profile_image_url" => $user_row->profile_image_url_https,
										"protected" => $user_row->protected,
										"lang" => $user_row->lang,
										"statuses_count" => $user_row->statuses_count,
										"source" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->source : "YOK",
										"user_detailed_params" => json_encode($user_row));
									}
									$form_data['success']=true;
									$form_data['message']="Success! Data fetched from twitter";
									
								}
								else{
									$form_data['message']="Error! Can't fetch any data from twitter";
								}
							}
							else{
								$form_data['message']="Error! Can't reach twitter with current credentials";
							}
						}
						$form_data['returned_users_insert_status']=TwitterUsers::bulkInsert($returned_users);
						$form_data['returned_users']=$returned_users;
					break;
					default:
						$form_data['message'] = 'Bad Query';
					break;
				}
			}
			else{
				$form_data['message'] = 'Bad Query';
			}
		break;
		case 'getfollowers':
			if(isset($screen_name) && isset($twitter_id)){
				//Get twitter details and make connection
				$app_credentials = TwitterHelper::getAppCredentials();
				$authed_user = AuthedUsers::getObj($twitter_id);
				$connection = new TwitterOAuth($app_credentials['consumer_key'], $app_credentials['consumer_secret'], $authed_user->oauth_token, $authed_user->oauth_token_secret);
				$returned_users = array();
				$next_cursor = isset($next_cursor) ? $next_cursor : -1;
				$previous_cursor = isset($previous_cursor) ? $previous_cursor : 0;
				// $content = $connection->get('followers/ids',array('screen_name' => $screen_name,'cursor'=>-1,'count' => TWITTER_GET_FOLLOWERS_ID_PP));
				$content = $connection->get('followers/list',array('screen_name' => $screen_name,'cursor'=>$next_cursor,'count' => TWITTER_GET_FOLLOWERS_LIST_PP,'include_user_entities'=>true,'skip_status'=>false));
				if($connection->getLastHttpCode() == 200){
					if ($content->users) {
						foreach ($content->users as $user_row) {
							//filtreyi buraya basacağız
							$returned_users[] = array("screen_name" => $user_row->screen_name,
							"actual_name" => $user_row->name,
							"followers_count" => $user_row->followers_count,
							"friends_count" => $user_row->friends_count,
							"location" => $user_row->location,
							"created_at" => $user_row->created_at,
							"last_updated" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->created_at : "",
							"id_str" => $user_row->id_str,
							"profile_image_url" => $user_row->profile_image_url_https,
							"protected" => $user_row->protected,
							"lang" => $user_row->lang,
							"statuses_count" => $user_row->statuses_count,
							"source" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->source : "YOK",
							"user_detailed_params" => json_encode($user_row));
						}
						$form_data['success']=true;
						$form_data['message']="Success! Data fetched from twitter";
						$next_cursor = $content->next_cursor_str;
						$previous_cursor = $content->previous_cursor_str;
					}
					else{
						$form_data['message']="Error! Can't fetch any data for this request";
					}
				}
				else{
					$body=isset($connection) ? $connection->getLastBody() : [];
					$errors=isset($body) && !empty($body) ? $body->errors : [];
					$error_text="";
					foreach($errors as $error){
						if($error->code==88){
							TwitterHelper::setUserLimitExceed($twitter_id);
							$new_twitter_id=TwitterHelper::getRandomUserId();
						}
						$error_text.="Code: ".$error->code." Message: ".$error->message."";
					}
					$form_data['message']="Error! Can't reach twitter with current credentials ### ".$error_text;
				}
				$form_data['returned_users_insert_status']=TwitterUsers::bulkInsert($returned_users);
				$form_data['returned_users']=$returned_users;
				$form_data['next_cursor']=$next_cursor;
				$form_data['previous_cursor']=$previous_cursor;
				$form_data['new_twitter_id']=$new_twitter_id['id'];
			}
			else{
				$form_data['message'] = 'Bad Query';
			}
		break;
		case 'getfriends':
			if(isset($screen_name) && isset($twitter_id)){
				//Get twitter details and make connection
				$app_credentials = TwitterHelper::getAppCredentials();
				$authed_user = AuthedUsers::getObj($twitter_id);
				$connection = new TwitterOAuth($app_credentials['consumer_key'], $app_credentials['consumer_secret'], $authed_user->oauth_token, $authed_user->oauth_token_secret);
				$returned_users = array();
				$next_cursor = isset($next_cursor) ? $next_cursor : -1;
				$previous_cursor = isset($previous_cursor) ? $previous_cursor : 0;
				// $content = $connection->get('friends/ids',array('screen_name' => $screen_name,'cursor'=>-1,'count' => TWITTER_GET_FOLLOWERS_ID_PP));
				$content = $connection->get('friends/list',array('screen_name' => $screen_name,'cursor'=>$next_cursor,'count' => TWITTER_GET_FOLLOWERS_LIST_PP,'include_user_entities'=>true,'skip_status'=>false));
				if($connection->getLastHttpCode() == 200){
					if ($content->users) {
						foreach ($content->users as $user_row) {
							//filtreyi buraya basacağız
							$returned_users[] = array("screen_name" => $user_row->screen_name,
							"actual_name" => $user_row->name,
							"followers_count" => $user_row->followers_count,
							"friends_count" => $user_row->friends_count,
							"location" => $user_row->location,
							"created_at" => $user_row->created_at,
							"last_updated" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->created_at : "",
							"id_str" => $user_row->id_str,
							"profile_image_url" => $user_row->profile_image_url_https,
							"protected" => $user_row->protected,
							"lang" => $user_row->lang,
							"statuses_count" => $user_row->statuses_count,
							"source" => $user_row->statuses_count>0 && isset($user_row->status) ? $user_row->status->source : "YOK",
							"user_detailed_params" => json_encode($user_row));
						}
						$form_data['success']=true;
						$form_data['message']="Success! Data fetched from twitter";
						$next_cursor = $content->next_cursor_str;
						$previous_cursor = $content->previous_cursor_str;
					}
					else{
						$form_data['message']="Error! Can't fetch any data for this request";
					}
				}
				else{
					$body=$connection->getLastBody();
					$errors=$body->errors;
					$error_text="";
					foreach($errors as $error){
						if($error->code==88){
							TwitterHelper::setUserLimitExceed($twitter_id);
							$new_twitter_id=TwitterHelper::getRandomUserId();
						}
						$error_text.="Code: ".$error->code." Message: ".$error->message."";
					}
					$form_data['message']="Error! Can't reach twitter with current credentials ### ".$error_text;
				}
				$form_data['returned_users_insert_status']=TwitterUsers::bulkInsert($returned_users);
				$form_data['returned_users']=$returned_users;
				$form_data['next_cursor']=$next_cursor;
				$form_data['previous_cursor']=$previous_cursor;
				$form_data['new_twitter_id']=$new_twitter_id['id'];
			}
			else{
				$form_data['message'] = 'Bad Query';
			}
		break;
	}
}
header('Content-Type: application/json');
echo json_encode($form_data);
?>