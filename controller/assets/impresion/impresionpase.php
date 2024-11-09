<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

echo $funciondata = json_encode(array('error' => false));
ob_end_flush();