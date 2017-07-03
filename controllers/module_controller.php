<?php
defined('_MYINC') or die();

class ModuleController
{
    public function dashboard() {
        ViewHelper::setTitle('Minyy | Dashboard');
        ViewHelper::getView('page','dashboard');
    }
    public function users() {
        require_once('controllers/users_controller.php');
        $do=isset($_GET['do']) ? $_GET['do'] : "list";
        switch($do){
            case "add":
            UsersController::add();
            break;
            case "edit":
            $id=isset($_GET['id']) && !empty($_GET['id']) ? (int) Functions::clearString($_GET['id']) : -1;
            UsersController::edit($id);
            break;
            case "remove":
            UsersController::remove();
            break;
            case "list":
            default:
            UsersController::getList();
            break;
        }
    }
    public function twitter_users() {
        require_once('controllers/twitter_users_controller.php');
        $do=isset($_GET['do']) ? $_GET['do'] : "list";
        switch($do){
            case "add":
            TwitterUsersController::add();
            break;
            case "edit":
            $id=isset($_GET['id']) && !empty($_GET['id']) ? (int) Functions::clearString($_GET['id']) : -1;
            TwitterUsersController::edit($id);
            break;
            case "remove":
            TwitterUsersController::remove();
            break;
            case "list":
            default:
            TwitterUsersController::getList();
            break;
        }
    }
}