<?php

require_once "Controllers/template.controller.php";
require_once "Controllers/users.controller.php";
require_once "Controllers/categories.controller.php";
require_once "Controllers/products.controller.php";

require_once "Models/users.model.php";
require_once "Models/categories.model.php";
require_once "Models/products.model.php";

$template = new TemplateController();
$template -> ctrTemplate(); 