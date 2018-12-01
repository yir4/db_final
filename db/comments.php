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

    public function postComment($params) {
        $queries = $params['params'];
        $sales_id = $queries['sales_id'];
        $order_id = $queries['order_id'];
        $text = $queries['comment_text'];
        $sql = "INSERT INTO comments ( order_id, sales_id, comment_text) VALUES ($order_id, $order_id, '$text')";
        $res = $this->query($sql);
        if ($res) {
            echo json_encode(['code'=>200, 'message'=>'ERR_SUCCESS']);
        } else {
            echo json_encode(['code'=>404, 'message'=>'ERR_FAIL']);
        }
    }
}
