<?
include("BaseModel.php");
class Products extends BaseModel {

    public function __construct($params) {
        parent::__construct();
        $func = $params['func'];
        $this->$func($params);
    }    
}
