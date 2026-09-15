<?php

session_start();

session_unset();
session_destroy();

header("Location: /it34a/index.php");
exit;

?>