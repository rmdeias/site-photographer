<?php
session_start();

session_unset();// supprimme toute les sessions présente
header('Location: ../../index.php');
exit;
   

