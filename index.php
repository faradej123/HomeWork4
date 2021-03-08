<?php
require_once($_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/Core/ClassLoader.php");

\Core\ClassLoader::getInstance()->register();
\Core\Router::getInstance()->register();