<?php
class TwitterUsers implements DatabaseObject {
    public $twitter_id;
    public $screen_name;
    public $actual_name;
    public $profile_image_url;
    public $followers_count;
    public $friends_count;
    public $location;
    public $created_at;
    public $last_updated;
    public $user_detailed_params;
    public $protected;
    public $lang;
    public $statuses_count;
    public $source;

    public function __construct($twitter_id, $screen_name, $actual_name, $profile_image_url, $followers_count, $friends_count, $location, $created_at, $last_updated, $user_detailed_params, $protected, $lang, $statuses_count, $source){
        $this->twitter_id=$twitter_id;
        $this->screen_name=$screen_name;
        $this->actual_name=$actual_name;
        $this->profile_image_url=$profile_image_url;
        $this->followers_count=$followers_count;
        $this->friends_count=$friends_count;
        $this->location=$location;
        $this->created_at=$created_at;
        $this->last_updated=$last_updated;
        $this->user_detailed_params=$user_detailed_params;
        $this->protected=$protected;
        $this->lang=$lang;
        $this->statuses_count=$statuses_count;
        $this->source=$source;
    }
    public static function insert($params){
        // $return=[];
        // if ($params === null || empty($params['username']) || empty($params['fullname']) || empty($params['password']) || empty($params['repassword']) || empty($params['email'])) {
        //     $return['status']=false;
        //     $return['message']=T::__("Please fill all required fields!",true);
        //     return $return;
        // }
        // elseif(empty($params['terms'])){
        //     $return['status']=false;
        //     $return['message']=T::__("Please agree the terms",true);
        //     return $return;
        // }
        // elseif($params['password'] != $params['repassword']){
        //     $return['status']=false;
        //     $return['message']=T::__("Passwords don't match!",true);
        //     return $return;
        // }
        // else{
        //     $params['username']=Functions::clearString($params['username']);
        //     $params['fullname']=Functions::clearString($params['fullname']);
        //     $params['email']=Functions::clearString($params['email']);
        //     $params['password']=md5($params['password']);
        //     $db = Db::getInstance();
        //     //check if credentials are exists on db 
        //     $req = $db->prepare('SELECT COUNT(pkUserId) FROM tw_users WHERE username=:username OR email=:email');
        //     $req->execute(array(
        //         'username' => $params['username'],
        //         'email' => $params['email']));
        //     $req->execute(); 
        //     if($req->fetchColumn()>0){
        //         $return['status']=false;
        //         $return['message']=T::__("This username or email already exists! You can login with your credentials!",true);
        //         return $return;
        //     }
        //     //if not, save it
        //     $req = $db->prepare('INSERT INTO users (username,password,email,fullname,registrationDate) VALUES (:username,:password,:email,:fullname,NOW())');
        //     $res=$req->execute(array(
        //         'username' => $params['username'],
        //         'fullname' => $params['fullname'],
        //         'email' => $params['email'],
        //         'password' => $params['password']));
        //     if($res){
        //         $return['status']=true;
        //         $return['message']=T::__("The account created succesfully. You can login with your account",true);
        //         return $return;
        //     }
        //     else{
        //         $return['status']=false;
        //         $return['message']=T::__("An error occured. Please contact with administrators!",true);
        //         return $return;
        //     }
        // }
    }
    public static function update($id,$params){
        // $return=[];
        // if ($params === null || empty($params['username']) || empty($params['fullname']) || empty($params['password']) || empty($params['repassword']) || empty($params['email'])) {
        //     $return['status']=false;
        //     $return['message']=T::__("Please fill all required fields!",true);
        //     return $return;
        // }
        // if(!empty($params['password']) && ($params['password'] != $params['repassword'])){
        //     $return['status']=false;
        //     $return['message']=T::__("Passwords don't match!",true);
        //     return $return;
        // }
        // else{
        //     $id=Functions::clearString($id);
        //     $params['username']=Functions::clearString($params['username']);
        //     $params['fullname']=Functions::clearString($params['fullname']);
        //     $params['email']=Functions::clearString($params['email']);
        //     $params['password']=md5($params['password']);
        //     $db = Db::getInstance();
        //     //check if credentials are exists on db 
        //     $req = $db->prepare('SELECT COUNT(pkUserId) FROM tw_users WHERE username=:username OR email=:email');
        //     $req->execute(array(
        //         'username' => $params['username'],
        //         'email' => $params['email']));
        //     $req->execute(); 
        //     if($req->fetchColumn()==0){
        //         $return['status']=false;
        //         $return['message']=T::__("User not found!",true);
        //         return $return;
        //     }
        //     //if exists, save it
        //     //burada kaldım update sorgusunu yazacam
        //     $req = $db->prepare('UPDATE users SET (username=:username,password=:username,email=:username,fullname=:username,registrationDate) VALUES (:username,:password,:email,:fullname,NOW())');
        //     $res=$req->execute(array(
        //         'username' => $params['username'],
        //         'fullname' => $params['fullname'],
        //         'email' => $params['email'],
        //         'password' => $params['password']));
        //     if($res){
        //         $return['status']=true;
        //         $return['message']=T::__("The account created succesfully. You can login with your account",true);
        //         return $return;
        //     }
        //     else{
        //         $return['status']=false;
        //         $return['message']=T::__("An error occured. Please contact with administrators!",true);
        //         return $return;
        //     }
        // }
        // try{
        //     $db=Db::getInstance();            
        //     $req = $db->prepare('UPDATE users SET username=:username, password=:password, email=:email, lastVisit=:lastVisit, fullname=:fullname, langID=:langID WHERE pkUserID=:id');
        //     $res=$req->execute(array('username'=>$obj['username'],
        //                             'password'=>$obj['password'],
        //                             'email'=>$obj['email'],
        //                             'lastVisit'=>$obj['lastVisit'],
        //                             'fullname'=>$obj['fullname'],
        //                             'langID'=>$obj['langID'],
        //                             'id'=>$id));
        // }
        // catch(PDOException $e){
        //     return $e->getMessage();
        // }
        // return $id;
    }
    public static function delete($id){
        // try{
        //     $db=Db::getInstance();            
        //     $req = $db->prepare('DELETE FROM tw_users WHERE id=:id');
        //     $res=$req->execute(array('id'=>$id));
        // }
        // catch(PDOException $e){
        //     return $e->getMessage();
        // }
        // return $id;
    }
    public static function getObjList($params){
        $list = [];

        $order_dirs=array("desc","asc");
        $key=array_search($params["order_dir"],$order_dirs);
        $order_dir=$order_dirs[($key) ? $key : 0];

        $order_columns=array("screen_name", "actual_name", "profile_image_url", "followers_count", "friends_count", "location", "created_at", "last_updated");
        $key=array_search($params["order_by"],$order_columns);
        $order_by=$order_columns[($key) ? $key : 0];

        $limit=$params["limit"] ? $params["limit"] : "25";
        $offset=$params["offset"] ? $params["offset"] : "0";

        $query="SELECT * FROM tw_user_list";
        if(!empty($params['search_term'])){
            $query.=" WHERE lower(concat(screen_name, '', actual_name, '', profile_image_url, '', followers_count, '', friends_count, '', location, '', created_at, '', last_updated)) LIKE :search_term";
        }
        $query.=" ORDER BY $order_by $order_dir LIMIT :offset , :limit";

        $db = Db::getInstance();
        $req = $db->prepare($query);
        $req->bindValue(':limit', intval($limit), PDO::PARAM_INT);
        $req->bindValue(':offset', intval($offset), PDO::PARAM_INT);
        if(!empty($params['search_term'])){
            $req->bindValue(':search_term', "%".Functions::replaceLiteralChars($params['search_term'])."%", PDO::PARAM_STR);
        }
        $req->execute();
        // we create a list of Post objects from the database results
        foreach($req->fetchAll() as $obj) {
            $list[] = new TwitterUsers($obj['twitter_id'],
                                $obj['screen_name'],
                                $obj['actual_name'],
                                $obj['profile_image_url'],
                                $obj['followers_count'],
                                $obj['friends_count'],
                                $obj['location'],
                                $obj['created_at'],
                                $obj['last_updated'],
                                $obj['user_detailed_params'],
                                $obj['protected'],
                                $obj['lang'],
                                $obj['statuses_count'],
                                $obj['source']);
        } 
        return $list;
    }
    public static function getObj($id){
        // try{
        //     $db = Db::getInstance();
        //     $id = intval($id);
        //     $req = $db->prepare('SELECT * FROM tw_users WHERE pkUserID = :pkUserID');
        //     $req->execute(array('pkUserID' => $id));
        //     $obj = $req->fetch();
        //     if($obj){
        //         return new Users( $obj['pkUserID'],
        //                             $obj['username'],
        //                             $obj['password'],
        //                             $obj['email'],
        //                             $obj['lastVisit'],
        //                             $obj['fullname'],
        //                             $obj['registrationDate']);
        //     }
        //     else{
        //         return [];
        //     }
        // }
        // catch (PDOException $e){
        //     return $e->getMessage();
        // }
    }
    public static function getTotal($search_term) {
      $query="SELECT COUNT(twitter_id) FROM tw_user_list";
      if(!empty($search_term))
        $query.=" WHERE lower(concat(screen_name, '', actual_name, '', profile_image_url, '', followers_count, '', friends_count, '', location, '', created_at, '', last_updated)) LIKE :search_term";
      $db = Db::getInstance();
      $req = $db->prepare($query);
      if(!empty($search_term))
        $req->bindValue(':search_term', "%".$search_term."%", PDO::PARAM_STR);
      
      $req->execute();
      $res=$req->fetch();
      return (int) $res[0];
    }
    public static function bulkInsert($returned_users){
        try{
            $db = Db::getInstance();
            
            $return['status']=true;
            $return['message']="";   
            $insert_sql_array=[];
            $update_sql_array=[];
            foreach($returned_users as $ru){
                foreach($ru as $kru=>$vru){
                    $ru[$kru]=Functions::clearString($vru);
                }
                $req = $db->prepare('SELECT COUNT(twitter_id) FROM tw_user_list WHERE twitter_id=:twitter_id');
                $req->execute(array('twitter_id' => $ru['id_str']));
                if($req->fetchColumn()>0){
                    //eğer dbde varsa update yap
                    $update_sql_array[]=sprintf("UPDATE tw_user_list SET screen_name='%s', actual_name='%s', profile_image_url='%s', followers_count='%s', friends_count='%s', location='%s', created_at='%s', last_updated='%s', user_detailed_params='%s', protected='%s', lang='%s', statuses_count='%s', source='%s' WHERE twitter_id='%s'", $ru['screen_name'], $ru['actual_name'], $ru['profile_image_url'], $ru['followers_count'], $ru['friends_count'], $ru['location'], $ru['created_at'], $ru['last_updated'], $ru['user_detailed_params'], $ru['protected'], $ru['lang'], $ru['statuses_count'], $ru['source'], $ru['id_str']);
                }
                else{
                    //yoksa insert sql oluştur
                    $insert_sql_array[]=sprintf("('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $ru['id_str'], $ru['screen_name'], $ru['actual_name'], $ru['profile_image_url'], $ru['followers_count'], $ru['friends_count'], $ru['location'], $ru['created_at'], $ru['last_updated'], $ru['user_detailed_params'], $ru['protected'], $ru['lang'], $ru['statuses_count'], $ru['source']);
                }
            }
            //şimdi insert sqli execute et
            $insert_sql="INSERT INTO tw_user_list (twitter_id, screen_name, actual_name, profile_image_url, followers_count, friends_count, location, created_at, last_updated, user_detailed_params, protected, lang, statuses_count, source) VALUES ";
            $insert_sql.=implode(',',$insert_sql_array);
            $insert_sql.=";";
            if(!empty($insert_sql_array)){
                $req = $db->prepare($insert_sql);
                $res = $req->execute();
                if($res){
                    $return['status']=true;
                    $return['message']="The users added succesfully.";
                }
                else{
                    $return['status']=false;
                    $return['message']="An error occured. Please contact with administrators!";
                }
            }

            if(!empty($update_sql_array)){
                $req = $db->prepare(implode(';',$update_sql_array));
                $res = $req->execute();
                if($res){
                    $return['status']=true;
                    $return['message'].="The users updated succesfully.";
                }
                else{
                    $return['status']=false;
                    $return['message'].="An error occured. Please contact with administrators!";
                }
            }
            return $return;
        }
        catch (PDOException $e){
            return $e->getMessage();
        }
    }
}