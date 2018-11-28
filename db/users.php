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
        $email = $queries['email'];
        $password = $queries['password'];
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $res = $this->queryArray($sql);
        if ($res) {
            $result['code'] = 200;
            $result['data'] = $res;
            $result['perm'] = 3;
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }
}
