<?php
session_start();

//Permite carregar os dados do .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

require __DIR__."/varglobals.php";
require __DIR__."/routes/router.php";