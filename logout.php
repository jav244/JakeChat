<?php
session_save_path('./');
session_start();
session_unset();
session_destroy();


?>