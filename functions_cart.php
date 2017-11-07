<?php
function getValue(array $array, $key, $default = null)
{
    if (isset($array[$key])) {
        return $array[$key];
    }
    
    return $default;
}
function redirect($to)
{
    header("Location: {$to}");
    die;
}
function requestPost($key, $default = null)
{
    return getValue($_POST, $key, $default);
}
function requestGet($key, $default = null)
{
    return getValue($_GET, $key, $default);
}
function cookieSet($name, $value, $expire = 3600, $path = '/')
{
    setcookie($name, $value, time() + $expire, $path);
}
function cookieRemove($name)
{
    cookieSet($name, '', -1);
    unset($_COOKIE[$name]);
}
function cookieGet($name, $default = null)
{
return getValue($_COOKIE, $name, $default);
}
// функция удаления товара из корзины
function removefromCart()
{
    $itemId = isset($_GET['id']) ? intval($_GET['id']): null;
    if (! $itemId) exit();
    $rsData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if ($key !== false) {
        unset ($_SESSION['cart'][$key]);
        $rsData['success'] = 1;
        $rsData['cncitems'] = count($_SESSION['cart']);
    }
    else{
        $rsData['success'] = 0;
    }
    echo $rsData;
}
removefromCart();
?>