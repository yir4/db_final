<?
$r = serializeURL();

if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "UPDATE") {
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
    case "customer":
        include_once('customer.php');
        return new Customer($r);
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
    foreach ($_POST as $key => $value) {
        $res[$key] = $value;
    }
    return $res;
}
