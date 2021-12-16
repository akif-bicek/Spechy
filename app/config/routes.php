<?php
$route = new route_helpers();
$route->get("auth", "auth_controllers.index");
$route->post("register", "auth_controllers.create");
$route->delete("auth_delete", "auth_controllers.delete");

$route->get("companies", "company_controllers.index");
$route->post("company_add", "company_controllers.create");
$route->delete("company_delete", "company_controllers.delete");

$route->get("package", "package_controllers.index");
$route->post("package_add", "package_controllers.create");
$route->delete("package_delete", "package_controllers.delete");

$route->post("register_package", "package_controllers.register");
$route->post("cancel_package", "package_controllers.cancel");

$route->get("customer_package", "package_controllers.customerPackage");
$route->get("company_package", "package_controllers.companyPackage");
$route->get("customer_payment", "package_controllers.payments");
?>