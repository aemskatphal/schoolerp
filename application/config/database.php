<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| Resolution order:
|   1. Server-side override file  application/config/database.prod.php
|      (NOT in git; created manually on the live server via File Manager.
|       Survives every deployment because it is not tracked.)
|   2. Environment variables DB_HOSTNAME / DB_USERNAME / DB_PASSWORD / DB_DATABASE
|      (optional; set in hPanel if preferred over the override file)
|   3. Local development defaults below (XAMPP: root, no password, school_db)
|
| No live credentials are ever committed to the repository.
*/

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'database' => 'school_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

/* 1) Server-side override file (created on the host, NOT tracked by git) */
$prod_config = __DIR__ . '/database.prod.php';
if (file_exists($prod_config)) {
	include $prod_config;
	return;
}

/* 2) Environment variables (hPanel -> site dashboard -> Environment Variables) */
if (getenv('DB_DATABASE') !== FALSE) {
	$db['default']['hostname'] = getenv('DB_HOSTNAME');
	$db['default']['username'] = getenv('DB_USERNAME');
	$db['default']['password'] = getenv('DB_PASSWORD');
	$db['default']['database'] = getenv('DB_DATABASE');
	return;
}

/* 3) Fall through to local development defaults above */
