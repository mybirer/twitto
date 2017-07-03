<?php
class Users implements DatabaseObject {
    public $pkUserID;
    public $username;
    public $password;
    public $email;
    public $lastVisit;
    public $fullname;
    public $registrationDate;

    public function __construct($pkUserID,$username,$password,$email,$lastVisit,$fullname,$registrationDate){
        $this->pkUserID=$pkUserID;
        $this->username=$username;
        $this->password=$password;
        $this->email=$email;
        $this->lastVisit=$lastVisit;
        $this->fullname=$fullname;
        $this->registrationDate=$registrationDate;
    }
    public static function insert($params){
        $return=[];
        if ($params === null || empty($params['username']) || empty($params['fullname']) || empty($params['password']) || empty($params['repassword']) || empty($params['email'])) {
            $return['status']=false;
            $return['message']=T::__("Please fill all required fields!",true);
            return $return;
        }
        elseif(empty($params['terms'])){
            $return['status']=false;
            $return['message']=T::__("Please agree the terms",true);
            return $return;
        }
        elseif($params['password'] != $params['repassword']){
            $return['status']=false;
            $return['message']=T::__("Passwords don't match!",true);
            return $return;
        }
        else{
            $params['username']=Functions::clearString($params['username']);
            $params['fullname']=Functions::clearString($params['fullname']);
            $params['email']=Functions::clearString($params['email']);
            $params['password']=md5($params['password']);
            $db = Db::getInstance();
            //check if credentials are exists on db 
            $req = $db->prepare('SELECT COUNT(pkUserId) FROM tw_users WHERE username=:username OR email=:email');
            $req->execute(array(
                'username' => $params['username'],
                'email' => $params['email']));
            $req->execute(); 
            if($req->fetchColumn()>0){
                $return['status']=false;
                $return['message']=T::__("This username or email already exists! You can login with your credentials!",true);
                return $return;
            }
            //if not, save it
            $req = $db->prepare('INSERT INTO tw_users (username,password,email,fullname,registrationDate) VALUES (:username,:password,:email,:fullname,NOW())');
            $res=$req->execute(array(
                'username' => $params['username'],
                'fullname' => $params['fullname'],
                'email' => $params['email'],
                'password' => $params['password']));
            if($res){
                $return['status']=true;
                $return['message']=T::__("The account created succesfully. You can login with your account",true);
                return $return;
            }
            else{
                $return['status']=false;
                $return['message']=T::__("An error occured. Please contact with administrators!",true);
                return $return;
            }
        }
    }
    public static function update($id,$params){
        $return=[];
        if ($params === null || empty($params['username']) || empty($params['fullname']) || empty($params['password']) || empty($params['repassword']) || empty($params['email'])) {
            $return['status']=false;
            $return['message']=T::__("Please fill all required fields!",true);
            return $return;
        }
        if(!empty($params['password']) && ($params['password'] != $params['repassword'])){
            $return['status']=false;
            $return['message']=T::__("Passwords don't match!",true);
            return $return;
        }
        else{
            $id=Functions::clearString($id);
            $params['username']=Functions::clearString($params['username']);
            $params['fullname']=Functions::clearString($params['fullname']);
            $params['email']=Functions::clearString($params['email']);
            $params['password']=md5($params['password']);
            $db = Db::getInstance();
            //check if credentials are exists on db 
            $req = $db->prepare('SELECT COUNT(pkUserId) FROM tw_users WHERE username=:username OR email=:email');
            $req->execute(array(
                'username' => $params['username'],
                'email' => $params['email']));
            $req->execute(); 
            if($req->fetchColumn()==0){
                $return['status']=false;
                $return['message']=T::__("User not found!",true);
                return $return;
            }
            //if exists, save it
            //burada kaldım update sorgusunu yazacam
            $req = $db->prepare('UPDATE tw_users SET (username=:username,password=:username,email=:username,fullname=:username,registrationDate) VALUES (:username,:password,:email,:fullname,NOW())');
            $res=$req->execute(array(
                'username' => $params['username'],
                'fullname' => $params['fullname'],
                'email' => $params['email'],
                'password' => $params['password']));
            if($res){
                $return['status']=true;
                $return['message']=T::__("The account created succesfully. You can login with your account",true);
                return $return;
            }
            else{
                $return['status']=false;
                $return['message']=T::__("An error occured. Please contact with administrators!",true);
                return $return;
            }
        }
        try{
            $db=Db::getInstance();            
            $req = $db->prepare('UPDATE tw_users SET username=:username, password=:password, email=:email, lastVisit=:lastVisit, fullname=:fullname, langID=:langID WHERE pkUserID=:id');
            $res=$req->execute(array('username'=>$obj['username'],
                                    'password'=>$obj['password'],
                                    'email'=>$obj['email'],
                                    'lastVisit'=>$obj['lastVisit'],
                                    'fullname'=>$obj['fullname'],
                                    'langID'=>$obj['langID'],
                                    'id'=>$id));
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
        return $id;
    }
    public static function delete($id){
        try{
            $db=Db::getInstance();            
            $req = $db->prepare('DELETE FROM tw_users WHERE id=:id');
            $res=$req->execute(array('id'=>$id));
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
        return $id;
    }
    public static function getObjList($params){
        $list = [];

        $order_dirs=array("desc","asc");
        $key=array_search($params["order_dir"],$order_dirs);
        $order_dir=$order_dirs[($key) ? $key : 0];

        $order_columns=array("pkUserID", "username", "email", "lastVisit", "fullname", "registrationDate");
        $key=array_search($params["order_by"],$order_columns);
        $order_by=$order_columns[($key) ? $key : 0];

        $limit=$params["limit"] ? $params["limit"] : "20";
        $offset=$params["offset"] ? $params["offset"] : "0";

        $query="SELECT * FROM tw_users";
        if(!empty($params['search_term'])){
            $query.=" WHERE lower(concat(pkUserID, '', username, '', email, '', lastVisit, '', fullname, '', registrationDate)) LIKE :search_term";
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
            $list[] = new Users( $obj['pkUserID'],
                                $obj['username'],
                                $obj['password'],
                                $obj['email'],
                                $obj['lastVisit'],
                                $obj['fullname'],
                                $obj['registrationDate']);
        }
        return $list;
    }
    public static function getObj($id){
        try{
            $db = Db::getInstance();
            $id = intval($id);
            $req = $db->prepare('SELECT * FROM tw_users WHERE pkUserID = :pkUserID');
            $req->execute(array('pkUserID' => $id));
            $obj = $req->fetch();
            if($obj){
                return new Users( $obj['pkUserID'],
                                    $obj['username'],
                                    $obj['password'],
                                    $obj['email'],
                                    $obj['lastVisit'],
                                    $obj['fullname'],
                                    $obj['registrationDate']);
            }
            else{
                return [];
            }
        }
        catch (PDOException $e){
            return $e->getMessage();
        }
    }
    public static function getTotal($search_term) {
      $query="SELECT COUNT(pkUserID) FROM tw_users";
      if(!empty($search_term))
        $query.=" WHERE lower(concat(pkUserID, '', username, '', email, '', lastVisit, '', fullname, '', registrationDate)) LIKE :search_term";
      $db = Db::getInstance();
      $req = $db->prepare($query);
      if(!empty($search_term))
        $req->bindValue(':search_term', "%".$search_term."%", PDO::PARAM_STR);
      
      $req->execute();
      $res=$req->fetch();
      return (int) $res[0];
    }
}