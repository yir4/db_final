<?
include("BaseModel.php");
class Orders extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getOrders($params) {
        $queries = $params['params'];
        $user_id = $queries['user_id'];
        $sql = "SELECT * FROM orders WHERE user_id = $user_id";
        $res = $this->queryArrays($sql);
        if ($res) {
            $result['code'] = 200;
            $result['data'] = $res;
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }
}
