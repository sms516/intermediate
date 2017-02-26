<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	'type' => 'MySQLDatabase',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'sutherla_tkd',
	'path' => ''
);
/*
$databaseConfig = array(
	'type' => 'MySQLDatabase',
	'server' => 'localhost',
	'username' => 'sutherla_tkdint',
	'password' => '!18P)3TSCl',
	'database' => 'sutherla_tkd',
	'path' => ''
);*/

// Set the site locale
i18n::set_locale('en_US');
if(Director::isTest()){
    SS_LOG::add_writer(new SS_LOGFileWriter('../silverstripe-errors-warnings.log'),SS_Log::WARN, '<=');
    SS_LOG::add_writer(new SS_LOGFileWriter('../silverstripe-errors.log'),SS_Log::ERR);
    if(Director::isLive()) {
    SS_Log::add_writer(new SS_LogEmailWriter('me@example.com'), SS_Log::ERR);
}
}
