<?php

require_once __DIR__.'/boot.php';

$_SESSION['user_id'] = null;
header('Location: /');
