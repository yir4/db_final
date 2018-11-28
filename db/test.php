<?
include("BaseModel.php");

class Test extends BaseModel {
    private $conn;
    public function __construct() {
        parent::__construct();
        $func = 'foo';
        $this->$func();
    }
    public function foo() {
        echo $this->segs;
        echo "    ".'foo';
    }

}
