<?
// $result = getModel();
$r = serializeURL();
switch ($r['model']) {
    case "users":
        include_once('users.php');
        return new Users($r);
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}

function serializeURL() {
    $segs = explode('/',$_SERVER['REQUEST_URI']);
    $tail = $segs[5];
    $t = explode('?',$tail);
    parse_str($t[1], $params);
    return ['model'=>$segs[4], 'func'=>$t[0], 'params'=>$params];
}
