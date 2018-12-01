<?
include("BaseModel.php");
class Subcategory extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }

    public function getSubategory($params) {
        $queries = $params['params'];
        $sql = "SELECT * FROM sub_category";
        $result = $this->queryArrays($sql);
        echo json_encode(['code'=>200, 'data'=>$result]);
    }
}
