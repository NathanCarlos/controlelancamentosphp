<?php
//Inclusão de Mensagens e da classe produto;
include_once '../includes/mensagem.php';
include_once '../conexao.php';
//Verificando se o usuário tem uma sessão guardada.
if(!isset($_SESSION['emailusuario'])){
    header('Location: ../index.php');
}
//Incluindo cabeçalho e o menu flutuante.
include_once '../includes/header-dashboard.php';
include_once '../includes/menu.php';
?>

Olá <?php echo $_SESSION['nomeusuario'];?>




<?php
//Incluindo rodapé.
include_once '../includes/footer-padrao.php';
?>