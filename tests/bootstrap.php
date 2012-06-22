<?php
error_reporting(E_ALL|E_STRICT|E_DEPRECATED);

spl_autoload_register(function($className) {
  $relativePath = str_replace('\\', '/', $className);
  $relativePath = trim($relativePath, '/') . '.php';
  if (file_exists(__DIR__ . '/../lib/' . $relativePath)) {
    require_once __DIR__ . '/../lib/' . $relativePath;
  }
});