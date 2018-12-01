<?
include("BaseModel.php");
class Orders extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getOrdersBySales($params) {
        $queries = $params['params'];
        $sales_id = $queries['sales_id'];
        $sql = "SELECT customer_id FROM customer WHERE sales_id = $sales_id";
        $res = $this->queryArrays($sql);

        if ($res) {
            foreach ($res as $customer) {
                $customers[] = $customer['customer_id'];
            }
            $p = implode(', ', $customers);
            $sql = "SELECT * FROM orders WHERE customer_id IN ($p)";
            $res = $this->queryArrays($sql);

            $result['code'] = 200;
            $result['data'] = $res;
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }

    public function getOrderDetail($params) {
        $queries = $params['params'];
    }
}
