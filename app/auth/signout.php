<?php

require __DIR__ . '/../../config/config.php';

session_unset();
session_destroy();

header('Location: /IT34A/index.php');
exit;