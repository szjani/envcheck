<?php
error_reporting(E_ALL|E_STRICT|E_DEPRECATED);

set_include_path(implode(PATH_SEPARATOR, array(
  get_include_path(),
  '/development/Frameworks/ZF_1.11_svn/library'
)));

spl_autoload_register(function($className) {
  $relativePath = str_replace(array('\\', '_'), '/', $className);
  $relativePath = trim($relativePath, '/') . '.php';
  if (file_exists(__DIR__ . '/../lib/' . $relativePath)) {
    require_once __DIR__ . '/../lib/' . $relativePath;
  } elseif (strpos($className, 'Zend') === 0) {
    require_once $relativePath;
  }
});