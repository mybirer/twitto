<?php
defined('_MYINC') or die();

class UsersController implements ModuleInterface
{
    public static function getList($params=array()) {
        //required libraries
        require_once('helpers/pagination_helper.php');
        global $objList;
        global $paginationHTML;
        global $params;
        $search_term=isset($_GET['search_term']) ? Functions::clearString($_GET['search_term']) : "";
        $order_by=isset($_GET['order_by']) && !empty($_GET['order_by']) ? strtolower(Functions::clearString($_GET['order_by'])) : "id";
        $order_dir=isset($_GET['order_dir']) && !empty($_GET['order_dir']) ? strtolower(Functions::clearString($_GET['order_dir'])) : "desc";
        $limit=isset($_GET['limit']) && !empty($_GET['limit']) ? (int) Functions::clearString($_GET['limit']) : 20;
        $page=isset($_GET['page']) && !empty($_GET['page']) ? (int) Functions::clearString($_GET['page']) : 1;
        
        $offset=($page-1)*$limit;
        $params=[
            "search_term"=>$search_term,
            "order_by"=>$order_by,
            "order_dir"=>$order_dir,
            "limit"=>$limit,
            "offset"=>$offset
        ];
        $objList = Users::getObjList($params);

        $pagination = (new Pagination());
        $pagination->setCurrent($page);
        $pagination->setRPP($limit);
        $pagination->setTotal(Users::getTotal($search_term));
        $pagination->setClasses(array("pagination","pagination-sm","no-margin","pull-right"));
        $paginationHTML = $pagination->parse();
        
        ViewHelper::setTitle('Minyy | Users');
        ViewHelper::getView('users','users');
    }
    public static function add() {
        if(isset($_POST['addUserForm'])){
            $_DATA=array('fullname'=>$_POST['addUserFormName'],
                        'username'=>$_POST['addUserFormUsername'],
                        'email'=>$_POST['addUserFormEmail'],
                        'password'=>$_POST['addUserFormPassword'],
                        'repassword'=>$_POST['addUserFormPassword2'],
                        'country'=>$_POST['addUserFormCountry'],
                        'phone'=>$_POST['addUserFormPhone'],
                        'picture'=>$_POST['addUserFormPicture'],
                        'about'=>$_POST['addUserFormAbout'],
                        'terms'=>'on');
            $req=Users::insert($_DATA);
            if (!$req['status']) {
                MessageHelper::setMessage(T::__("Error",true),"danger","ban",$req['message']);
            }
            else{
                MessageHelper::setMessage(T::__("Success",true),"success","check",$req['message']);
            }
        }
        UsersController::getList();
    }


    public static function edit($id) {
        if(isset($_POST['editRecordForm'])){
            $id=$_POST['editUserFormId'];
            $_DATA=array('fullname'=>$_POST['editUserFormName'],
                        'username'=>$_POST['editUserFormUsername'],
                        'email'=>$_POST['editUserFormEmail'],
                        'password'=>$_POST['editUserFormPassword'],
                        'repassword'=>$_POST['editUserFormPassword2'],
                        'country'=>$_POST['editUserFormCountry'],
                        'phone'=>$_POST['editUserFormPhone'],
                        'picture'=>$_POST['editUserFormPicture'],
                        'about'=>$_POST['editUserFormAbout'],
                        'terms'=>'on');
            $result=Forms::update($id,$_DATA);
            if (!$req['status']) {
                MessageHelper::setMessage(T::__("Error",true),"danger","ban",$req['message']);
            }
            else{
                MessageHelper::setMessage(T::__("Success",true),"success","check",$req['message']);
            }
        }
        UsersController::getList();
        if(isset($_POST['editRecordFormDelete'])){
            $result=Forms::delete($id);
            if(strlen($result)>5){
                $alertType="danger";
                $alertTitle="Hata!";
                $alertText="Bir sorun oluştu! Hata:".$result;
            }
            else{
                $alertType="success";
                $alertTitle="Silindi!";
                $alertText="Kayıt Başarıyla Silindi!";
            }
            $redirect=true;
        }
        $obj=Users::getObj($id);
        if(empty($obj)){
            //burada kaldım
            $alertType="danger";
            $alertTitle="Hata!";
            $alertText="İlgili kayıt bulunamadı! Lütfen listeden bir kayıt seçiniz!";
        }
    }

    public static function remove($id) {
        $id=isset($_GET['id']) && !empty($_GET['id']) ? (int) Functions::clearString($_GET['id']) : -1;
        if(isset($_POST['editRecordForm'])){
            $form=array('name'=>$_POST['editRecordFormName'],
                        'surname'=>$_POST['editRecordFormSurname'],
                        'gender'=>$_POST['editRecordFormGender'],
                        'birth'=>$_POST['editRecordFormBirth'],
                        'education'=>$_POST['editRecordFormEducation'],
                        'phone'=>$_POST['editRecordFormPhone'],
                        'email'=>$_POST['editRecordFormEmail'],
                        'job'=>$_POST['editRecordFormJob'],
                        'job_detail'=>$_POST['editRecordFormCustomJob'],
                        'city'=>$_POST['editRecordFormCity'],
                        'custom_country'=>$_POST['editRecordFormCustomCountry'],
                        'custom_city'=>$_POST['editRecordFormCustomCity'],
                        'message'=>$_POST['editRecordFormMessage'],
                        'about'=>$_POST['editRecordFormAbout'],
                        'profile_link'=>$_POST['editRecordFormProfileLink'],
                        'level'=>$_POST['editRecordFormLevel'],
                        'want'=>isset($_POST['editRecordFormWant']) ? $_POST['editRecordFormWant'] : array(),
                        'status'=>$_POST['editRecordFormStatus'],
                        'result'=>$_POST['editRecordFormResult'],
                        'result_detail'=>$_POST['editRecordFormCustomResult'],
                        'source'=>$_POST['editRecordFormSource'],
                        'source_detail'=>$_POST['editRecordFormCustomSource'],
                        'followed_for'=>$_POST['editRecordFormFollowedFor'],
                        'modified_by'=>$_SESSION['user_id']);
            $result=Forms::edit($form,$id);
            if(strlen($result)>5){
                $alertType="danger";
                $alertTitle="Hata!";
                $alertText="Bir sorun oluştu! Hata:".$result;
            }
            else{
                $alertType="success";
                $alertTitle="Düzenlendi!";
                $alertText="Kayıt Başarıyla Düzenlendi!";
            }
            $redirect=false;
        }
        if(isset($_POST['editRecordFormDelete'])){
            $result=Forms::delete($id);
            if(strlen($result)>5){
                $alertType="danger";
                $alertTitle="Hata!";
                $alertText="Bir sorun oluştu! Hata:".$result;
            }
            else{
                $alertType="success";
                $alertTitle="Silindi!";
                $alertText="Kayıt Başarıyla Silindi!";
            }
            $redirect=true;
        }
        $record=Forms::find($id);
        if(gettype($record)!="object"){
            $alertType="danger";
            $alertTitle="Hata!";
            $alertText="İlgili kayıt bulunamadı! Lütfen listeden bir kayıt seçiniz!";
        }
        require_once('views/forms/forms_edit.php');
    }
}
?>