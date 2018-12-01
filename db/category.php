<?
include("BaseModel.php");
class Category extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getCategory($params) {
        $sql = "SELECT * FROM category";
        $result = $this->queryArrays($sql);
        echo json_encode(['code'=>200, 'data'=>$result]);
    }
}
