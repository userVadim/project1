<?php

$DBpar=include '../../config/db.php';

$db=new PDO('mysql:host='.$DBpar['host'].';dbname='.$DBpar['dbname'],$DBpar['user'],$DBpar['password'],[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


