<?php
include_once 'includes/mensagem.php';
include_once 'classes/Usuario.php';
include_once 'includes/header-padrao.php';
include_once 'conexao.php';
if(isset($_SESSION['emailusuario'])){
    echo "<script>location.href='dashboard/';</script>";
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
        echo "<script>location.href='experimentar.php';</script>";
    }
    else if($usuario->verificaUsuario($conexao,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)) === 2){
        $_SESSION['mensagem'] = "Email ou senha inválidos.";
        echo "<script>location.href='experimentar.php';</script>";
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
    <div class="row"><br/>
        <form class="card-panel grey lighten-5 col s12 m6 push-m3" method="post" action="<?php #PHP_SELF[''];?>" style="margin-top:3%;">
          <h5 class="left black-text text-lighten-2">Preencha o Formulário e Clique em Continuar</h5>
    <?php
    //Verificando se o usuário clicou em continuar.
    if(isset($_POST['btnContinuar']))
        {
            $nome = filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_SPECIAL_CHARS);//Limpa códigos html para não cria-los na página se o usuário colocar.
            $senha = filter_input(INPUT_POST, 'senha_usuario', FILTER_SANITIZE_SPECIAL_CHARS);//Limpa códigos html para não cria-los na página se o usuário colocar.
            $email = filter_input(INPUT_POST, 'email_usuario', FILTER_SANITIZE_EMAIL);//Limpa os caracteres especiais e retira-os da página só para ficar os dados corretos para email.
            $plano  = filter_input(INPUT_POST,'plano', FILTER_SANITIZE_NUMBER_INT);//Remove texto e coloca só os números, por exemplo jsakdjs56, ele coloca só 56 na tela.(números inteiros)
            $senha_criptografada = $usuario->criptografar($senha);
            if($usuario->insereDados($conexao, $nome, $email, $senha_criptografada, $plano) === 1)
            {
            $lista = $usuario->verificaUsuario($conexao,$email,$senha);
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
            else
            {
                echo "<div class='input-field col s6'><p class='red-text left'>Esse email já está em uso, por favor coloque outro.</p></div>";
            }
            
        }

    ?>
              <div class="input-field col s6 ">
                  <input id="nome" name="nome_usuario" type="text" class="validate black-text" required maxlength="50">
                <label for="nome">Seu Nome / Nome da Empresa</label>
              </div>
              <div class="input-field col s12">
                  <input id="email1" name="email_usuario" type="email" class="validate black-text" maxlength="100">
                <label for="email1">Email</label>
              </div>
              <div class="input-field col s6">
                  <input id="senha" name="senha_usuario" type="password" class="validate" required maxlength="50">
                <label for="senha">Senha</label>
              </div>
              <div class="input-field col s12">
                  <select name="plano">
                      <option value="1" selected>Mensal - R$10,00</option>
                      <option value="2">Trimestral - R$28,00</option>
                      <option value="3">Semestral - R$55,00</option>
                      <option value="4">Anual - R$80,00</option>
                  </select>
                  <label>Planos</label>
              </div>
              <div class="row">
              <div class="input-field col s12">
                  <label>
                      <span>A clicar em continuar você estará concordando com nossos termos e condições.</span>
                  </label>
              </div>
              </div>
              <br/>

              <input type="submit" class="btn blue darken-3" value="Continuar" name="btnContinuar" />
              <div class="row"></div>
      </form>
    </div>    
  <!-- Compiled and minified JavaScript -->
  <footer class="page-footer grey darken-4">
    <div class="footer-copyright">
      <div class="container">
          ©AlphaTechnologies
      </div>
    </div>
  </footer>

  <!--  Scripts--><!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
      M.AutoInit();
  </script>
  </body>
</html>