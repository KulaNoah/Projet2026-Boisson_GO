<?php

session_destroy();

header("Location: ../index_.php?page=login.php");
exit();