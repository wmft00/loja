<?php
error_reporting(0);

defined('SYSPATH') OR die('No direct access allowed.');

return array
    (
    'default' => array
        (
        'type' => 'mysqli',
        'connection' => array(
            /**
             * The following options are available for MySQL:
             *
             * string   hostname     server hostname, or socket
             * string   database     database name
             * string   username     database username
             * string   password     database password
             * boolean  persistent   use persistent connections?
             * array    variables    system variables as "key => value" pairs
             *
             * Ports and sockets may be appended to the hostname.
             */
            'hostname' => 'localhost',
            'database' => 'id16635682_lojatroc',
            'username' => 'id16635682_userlojatroc',
            'password' => 'l%(75^0KpMGpw5u%',
            'persistent' => FALSE,
        ),
        'table_prefix' => '',
        'charset' => 'utf8',
        'caching' => FALSE,
        'profiling' => TRUE,
    )
);
