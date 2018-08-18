<?php
//Iniciando sessão.
session_start();
//Unsetando todas as sessões.
session_unset();
//Destruindo todas as sessões.
session_destroy();

header('Location: ../index.php?msg=deslogado');
?>
