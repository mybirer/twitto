<?php
class TwitterHelper {
    public static function getAppCredentials(){ //todo use this function for parsing raw text
        try{
            $query="SELECT * FROM tw_ap_settings";
            $db = Db::getInstance();
            $req = $db->prepare($query);
            $req->execute();
            $res=$req->fetch();
            return $res;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public static function getRandomUserId(){ //todo use this function for parsing raw text
        try{
            $db = Db::getInstance();
            $req = $db->prepare("UPDATE tw_authed_users SET rl_status='normal', rle_time=NULL WHERE ((TIME_TO_SEC(NOW()) - TIME_TO_SEC(rle_time))/60)>15");
            $req->execute();

            $req = $db->prepare("SELECT * FROM tw_authed_users WHERE rl_status IS NULL or rl_status='normal' ORDER BY RAND() LIMIT 1");
            $req->execute();
            $res=$req->fetch();
            return $res;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public static function setUserLimitExceed($twitter_id){ //todo use this function for parsing raw text
        try{
            $query="UPDATE tw_authed_users SET rl_status='exceed', rle_time=NOW() WHERE id='{$twitter_id}'";
            
            $db = Db::getInstance();
            $req = $db->prepare($query);
            $res=$req->execute();
            return $res;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public static function is_on_friend_list($twitter_id,$check_id) {
        //Check if user is on friend list
        $query="SELECT * FROM " . DB_PREFIX . "fr_" . $twitter_id . " WHERE twitter_id ='" . $this->prep($check_id) . "'";
        $db = Db::getInstance();
        $req = $db->prepare($query);
        $req->execute();
        $res=$req->fetch();
        return !$res ? false : true;
    }
}