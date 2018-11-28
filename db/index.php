<?
// $result = getModel();
$r = serializeURL();
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
