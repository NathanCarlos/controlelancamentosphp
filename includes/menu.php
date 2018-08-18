<!--Menu flutuante.-->
<ul id="slide-out" class="sidenav">
    <li><a href="#!" class="waves-effect"><i class="material-icons">account_box</i>Minha Conta</a></li>
    <li><a href="../dashboard" class="waves-effect"><i class="material-icons">home</i>Visão Geral</a></li>
    <li><a href="#!" class="waves-effect"><i class="material-icons">person_pin</i>Clientes</a></li>
    <li><a href="produtos.php" class="waves-effect"><i class="material-icons">storage</i>Produtos</a></li>
    <li><a href="#!" class="waves-effect"><i class="material-icons">attach_money</i>Financeiro</a></li>
    <li><div class="divider"</div></li>
    <li><a href="sair.php" class="waves-effect"><i class="material-icons">exit_to_app</i>Sair</a></li>
</ul>
<!--Botão para exibir o menu flutuante.-->
<div class="row">
    <a style="margin-left: 5px;margin-top: 5px;" id="menu" href="#" data-target="slide-out" class="sidenav-trigger btn blue"><i class="small white-text material-icons">menu</i></a>
</div>
    
<!--Script de inicialização do menu flutuante.-->
<script>
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });       
</script>