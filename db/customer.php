<? //customer
include("BaseModel.php");
class Customer extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getCustomers($params) {
        $queries = $params['params'];
        $user_id = $queries['user_id'];
        $sql = "SELECT * FROM customer WHERE sales_id = $user_id";
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
