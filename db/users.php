<?
include("BaseModel.php");
class Users extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function login($params) {
        $queries = $params['params'];
        $username = $queries['username'];
        $password = $queries['password'];
        $sql = "SELECT * FROM user_permission WHERE user_name = '$username' AND user_password = '$password'";
        $res = $this->queryArray($sql);
        if ($res) {
            $result['code'] = 200;
            if ($res['user_permission'] == 2) {
                $sql = "SELECT * FROM sales WHERE user_id =".$res['user_id'];
                $sales = $this->queryArray($sql);
                $r = $sales;
            } else if ($res['user_permission'] == 1) {
                $sql = "SELECT * FROM customers WHERE user_id =".$res['user_id'];
                $customer = $this->queryArray($sql);
                $r = $customer;
            }
            $result['data'] = $r;
            $result['perm'] = $res['user_permission'];
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }
}
