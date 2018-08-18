<?php
include_once 'includes/mensagem.php';
include_once 'classes/Usuario.php';
include_once 'includes/header-padrao.php';
include_once 'conexao.php';
if(isset($_SESSION['emailusuario'])){
    echo "<script>location.href='dashboard/';</script>";
}
if(isset($_GET['msg'])){
    $_SESSION['mensagem'] = 'Deslogado com sucesso!';
    header('Location: index.php');
}
?>

<?php
//Instância da classe Usuario.
$usuario = new Usuario();
//Verifica se o usuário clicou em fazer login.
if(isset($_POST['btn-entrar'])){
    //Verificando se o retorno do usuário foi verdadeiro.
    if($usuario->verificaUsuario($conexao,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)) === 0){
        $_SESSION['mensagem'] = "Email ou senha inválidos.";
        echo "<script>location.href='index.php';</script>";
    }
    else if($usuario->verificaUsuario($conexao,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)) === 2){
        $_SESSION['mensagem'] = "Email ou senha inválidos.";
        echo "<script>location.href='index.php';</script>";
    }
    else{ //Passando retorno da lista para um váriavel lista.
        $lista = $usuario->verificaUsuario($conexao,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
        //Percorrendo cada array da lista e passando para a variável linha.
        foreach($lista as $linha):
        //Armazenando dados do usuário nas sessions.
        $_SESSION['nomeusuario'] = $linha['nome_usuario'];
        $_SESSION['emailusuario'] = $linha['email_usuario'];
        $_SESSION['idusuario'] = $linha['id_usuario'];
        $_SESSION['pagamento_pendente'] = $linha['pagamento_pendente'];
        endforeach;
        echo "<script>location.href='dashboard/';</script>";
    }
}
?>
    <!--Estrutura do Modal de Login-->
    <div id="modallogin" class="modal">
        <div class="modal-content">
            <form action="<?php #PHP_SELF[''];?>" method="POST">
                <h4>Fazer Login</h4>
                <p>Preencha seus dados para entrar.</p>
            <div class="input-field col s12">
                <input type="email" name="email" id="email" maxlength="100">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha" maxlength="50">
                <label for="senha">Senha</label>
            </div>
            <div class="modal-footer">
                <a href="#!" class="left blue-text">Esqueci minha senha</a><br/>
                <button type="submit" name="btn-entrar" class="btn blue left" style="margin-right:2.5px;">Entrar</button>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn blue left">Cancelar</a>
            </div>
            </form>
        </div>
    </div>
    <!--Divisão onde é colocada a imagem de divulgação e um botão para começar.-->
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center white-text text-lighten-2">OnGest</h1>
                <div class="row center">
                    <h5 class="header col s12 light">Está buscando uma maneira de controlar o seu estoque e clientes?</h5>
                </div>
                <div class="row center">
                    <a href="experimentar.php" id="download-button" class="modal-trigger btn-large waves-effect waves-light blue darken-3">Experimentar</a>
                </div>
            <br><br>
            </div>
        </div>
        <div class="parallax"><img src="imagens/background1.jpg" alt="Unsplashed background img 1"></div>
    </div>
    <!--Aqui a acaba a divisão onde é colocada a imagem de divulgação e botão.-->
    <!--Divisão onde colocamos o porque o cliente deve utilizar o nosso sistema.-->
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m4">
                  <div class="icon-block">
                    <h2 class="center blue-text text-darken-3"><i class="material-icons">person_pin</i></h2>
                    <h5 class="center">Controle de Clientes</h5>

                    <p class="light">Com a nossa Plataforma você pode controlar os seus clientes de forma fácil e rápida.</p>
                  </div>
                </div>

                <div class="col s12 m4">
                  <div class="icon-block">
                    <h2 class="center blue-text text-darken-3"><i class="material-icons">storage</i></h2>
                    <h5 class="center">Controle de Produtos</h5>

                    <p class="light">A maior vantagem de controlar os seus produtos com o nosso sitema é poder visualiza-los de forma mais simples e agradável.</p>
                  </div>
                </div>

                <div class="col s12 m4">
                  <div class="icon-block">
                    <h2 class="center blue-text text-darken-3"><i class="material-icons">attach_money</i></h2>
                    <h5 class="center">Controle do Financeiro</h5>

                    <p class="light">Controle os seus custos com a nossa ferramenta e nunca mais tenha prejuízos sem saber de onde eles vem.</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--Aqui termina a divisão onde explicamos o porque o cliente deve comprar o sistema.-->
<?php
include_once 'includes/footer-padrao.php';
?>
