<?php
require_once '../../libraries/MysqliDb/MysqliDb.php';

//  Get instance of DB object
function getDbInstance()
{
	return new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
}

spl_autoload_register('apiAutoload');

function apiAutoload($classname)
{
    if (preg_match('/[a-zA-Z]+Controller$/', $classname))
    {
        include __DIR__ . '/controllers/' . $classname . '.php';
        return true;
    }
    elseif (preg_match('/[a-zA-Z]+Model$/', $classname))
    {
        include __DIR__ . '/models/' . $classname . '.php';
        return true;
    }
    elseif (preg_match('/[a-zA-Z]+View$/', $classname))
    {
        include __DIR__ . '/views/' . $classname . '.php';
        return true;
    }
    else
    {
        include __DIR__ . '/library/' . str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
        return true;
    }

    return false;
}

$request = new Request();

// route the request to the right place
$class = str_replace('-', '', ucwords($request->url_elements[0], '-'));
$controller_name = $class . 'Controller';

if (class_exists($controller_name))
{
    $controller = new $controller_name();
    $action_name = strtolower($request->method) . 'Action';
    $result = $controller->$action_name($request);

    $view_name = ucfirst($request->format) . 'View';
    if (class_exists($view_name))
    {
        $view = new $view_name();
        $view->render($result);
    }
}
