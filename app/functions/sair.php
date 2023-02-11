<?php

    if (isset($_SESSION)) {
        session_destroy();
        header("Location: /");
        die();
    }
    
    header("Location: /");
    die();