<?php

require_once "../classes/Middleware.php";
require_once "../classes/ServiceRequest.php";

Middleware::requireRole("user");

if (!isset($_GET['id'])) {

    die("Invalid Request");
}

$service = new ServiceRequest();

$service->delete($_GET['id'], $_SESSION['user_id']);

header("Location: my-requests.php");

exit();

?>