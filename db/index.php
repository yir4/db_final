<?
$r = serializeURL();

if ($_SERVER['REQUEST_METHOD'] === "POST" || $_SERVER['REQUEST_METHOD'] === "PUT") {
    $r['params'] = extractParameters();
    // echo $_SERVER['REQUEST_METHOD'];
}

switch ($r['model']) {
    case "users":
        include_once('users.php');
        return new Users($r);
    case "comments":
        include_once('comments.php');
        return new Comments($r);
    case "orders":
        include_once('orders.php');
        return new Orders($r);
    case "customers":
        include_once('customers.php');
        return new Customers($r);
    case "products":
        include_once('products.php');
        return new Products($r);
    default:
        echo "You forgot to include the php file";
}

function serializeURL() {
    $segs = explode('/',$_SERVER['REQUEST_URI']);
    $tail = $segs[5];
    $t = explode('?',$tail);
    parse_str($t[1], $params);
    return ['model'=>$segs[4], 'func'=>$t[0], 'params'=>$params];
}

function extractParameters() {
    $target = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $target = $_POST;
    } else {
        parse_str(file_get_contents("php://input"),$target);
    }
    foreach ($target as $key => $value) {
        $res[$key] = $value;
    }
    return $res;
}
