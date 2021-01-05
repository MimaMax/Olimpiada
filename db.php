<?php

require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=promagent',
        'mysql', 'mysql' );

session_start();
