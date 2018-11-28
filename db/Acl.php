<?php
include("BaseModel.php");
class Acl extends BaseModel {
    private $user_empty = false;
   //initialize the database object here
   function __construct() {
       parent::__construct();
   }

    function check($permission,$userid,$group_id) {
        //we check the user permissions first
        if(!$this->user_permissions($permission,$userid)) {
            return false;
        }
        // if(!$this->group_permissions($permission,$group_id) & $this->isUserEmpty()) {
        //     return false;
        // }
        return true;
    }

    function user_permissions($permission,$userid) {
        $users = $this->db->query("SELECT COUNT(*) AS count FROM user_permissions WHERE permission_name='$permission' AND userid='$userid' ");
        // if($users['count']>0) {
        //     $result = $this->db->query("SELECT * FROM user_permissions WHERE permission_name='$permission' AND userid='$userid' ");
        //     $f = $this->db->f();
        //     if($f['permission_type']==0) {
        //         return false;
        //     }
        //     return true;
        // }
        // $this->setUserEmpty('true');
        return true;
    }

    function group_permissions($permission,$group_id) {
        $this->db->query("SELECT COUNT(*) AS count FROM group_permissions WHERE permission_name='$permission' AND group_id='$group_id' ");
        $f = $this->db->f();
        if($f['count']>0) {
            $this->db->query("SELECT * FROM group_permissions WHERE permission_name='$permission' AND group_id='$group_id' ");
            $f = $this->db->f();
            if($f['permission_type']==0) {
                return false;
            }
            return true;
        }
        return true;
    }

    function setUserEmpty($val) {
        $this->userEmpty = $val;
    }

    function isUserEmpty() {
       return $this->userEmpty;
    }
}
?>
