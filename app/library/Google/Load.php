<?php

    $tmpDir = getcwd();
    chdir( app_path() . '/libs' );
    require_once 'Google/Client.php';
    chdir( $tmpDir );