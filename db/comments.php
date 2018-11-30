<?
include("BaseModel.php");
class Comments extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getComments($params) {
        $queries = $params['params'];
        $sales_id = $queries['sales_id'];
        $sql = "SELECT * FROM comments WHERE sales_id = $sales_id";
        $res = $this->queryArrays($sql);
        if ($res) {
            $result['code'] = 200;
            $result['data'] = $res;
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }

    public function getCommentDetail($params) {
        $queries = $params['params'];
        $user_id = $queries['user_id'];
        $sql = "SELECT * FROM comments WHERE user_id = $user_id";
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
