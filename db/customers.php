<? //customer
include("BaseModel.php");
class Customers extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getCustomersBySales($params) {
        $queries = $params['params'];
        $sales_id = $queries['sales_id'];
        $sql = "SELECT * FROM customers WHERE sales_id = $sales_id";
        $res = $this->queryArrays($sql);
        if ($res) {
            $result['code'] = 200;
            $result['data'] = $res;
        } else {
            $result['code'] = 404;
        }
        echo json_encode($result);
    }

    public function createNewCustomer($params) {
        $queries = $params['params'];
        $result = ['code'=>404, 'message'=>'FAIL TO CREATE NEW CUSTOMER!'];
        // create new user in user permission
        if (isset($queries['login_account']) && isset($queries['login_password'])) {
            $user_permission = ['user_name'=>$queries['login_account'], 'user_password'=>$queries['login_password'], 'user_permission'=> 1];
            $sql = $this->queryInsert('user_permission', $user_permission);
            $res = $this->query($sql);
            if ($res) {
                $t = $queries['login_account'];
                $sql = "SELECT user_id FROM user_permission WHERE user_name = '$t'";
                $user = $this->queryArray($sql);
                if ($user) {
                    // retrieve user_id and insert data into customers
                    unset($queries['login_account']);
                    unset($queries['login_password']);
                    $queries['user_id'] = $user['user_id'];

                    $sql = $this->queryInsert('customers', $queries);
                    $res = $this->query($sql);
                    if ($res) {
                        $result = ['code'=>200, 'message'=>'ERR_SUCCESS'];
                    }
                }
            }
        }
        echo json_encode($result);

    }
}
