<?php

define('DIR_NEWTIK', DIR_SYSTEM . 'library/newtik/');



//include_once DIR_NEWTIK . '/helper/settings.php';
if (file_exists(DIR_NEWTIK . 'system/engine/admin_module_controller.php')) {
    include_once DIR_NEWTIK . 'system/engine/admin_module_controller.php';
}
if (file_exists(DIR_NEWTIK . 'system/engine/admin_extension_model.php')) {
    include_once DIR_NEWTIK . 'system/engine/admin_extension_model.php';
}
if (file_exists(DIR_NEWTIK . 'system/engine/admin_extension_model.php')) {
    include_once DIR_NEWTIK . 'system/engine/admin_extension_model.php';
}
if (file_exists(DIR_NEWTIK . 'system/engine/catalog_module_controller.php')) {
    include_once DIR_NEWTIK . 'system/engine/catalog_module_controller.php';
}
if (file_exists(DIR_NEWTIK . 'system/library/template.php')) {
    include_once DIR_NEWTIK . 'system/library/template.php';
}
if (file_exists(DIR_NEWTIK . 'system/library/template/twig.php')) {
    include_once DIR_NEWTIK . 'system/library/template/twig.php';
}
spl_autoload_register(function ($class_name) {

    $classs = explode('\\', $class_name);

    if (current($classs) != 'NewTik')
        return;
    array_shift($classs);

    if (current($classs) == 'API') {
        array_unshift($classs, 'vendor');
    }
    
    if (current($classs) == 'OpenCarEngine') {
        array_shift($classs);
        include_once DIR_NEWTIK . 'system/engine/' . (implode('/', $classs)) . '.php';
        return;
    }

    include_once DIR_NEWTIK . (implode('/', $classs)) . '.php';
});
