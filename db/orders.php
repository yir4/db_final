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
        $order_id = $queries['order_id'];
        $sql = "SELECT a.price AS total_price, a.status, a.timestamp, b.quantity, c.product_name, c.price AS single_price, d.category_name, e.sub_category_name
                FROM orders AS a, orders_detail AS b, product AS c, category AS d, sub_category AS e
                WHERE a.order_id = b.order_id AND b.product_id = c.product_id AND c.sub_category_id = e.sub_category_id AND d.category_id = e.category_id AND a.order_id = $order_id";
        $orderDetail = $this->queryArray($sql);

        if ($orderDetail) {
            $sql = "SELECT a.*, b.contact_name FROM comments AS a LEFT JOIN sales AS b ON a.sales_id = b.sales_id WHERE  a.order_id = $order_id ORDER BY a.comment_time DESC";
            $orderDetail['comments'] = $this->queryArrays($sql);
            if ($orderDetail['comments']) {
                $result['code'] = 200;
                $result['data'] = $orderDetail;
                echo json_encode($result);
                exit;
            }
        }
        echo json_encode(['code'=>404, 'meesage'=>'NO DATA']);
    }
}
