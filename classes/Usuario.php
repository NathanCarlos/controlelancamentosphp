<?php
    class Usuario{
        public $id_usuario;
        public $nome_usuario;
        public $email_usuario;
        public $senha_usuario;
        public $receber_novidades;
        public $pagamento_pendente;
        public $data_expiracao;
        
        //Método de verificação se o usuário existe ou não na base de dados.
        public function verificaUsuario($conexao,$email,$senha)
        {
            //Verificando se email digitado existe no banco de dados.
            $query = "SELECT * FROM usuarios WHERE email_usuario = '$email'";
            $resultado = $conexao->query($query);
            {
                //Verificando dados da lista de usuários com esse email(só 1).
                if($lista = $resultado->fetchAll()){
                    //Passando senha do usuaário para uma variável.
                    foreach($lista as $linha):
                     $senha_db = $linha['senha_usuario'];
                    endforeach;
                    if($senha_db <> "")
                    {
                        //Verificando se a senha que o usuário digitou é a mesma que a que está no banco.
                        if(password_verify($senha, $senha_db))
                        {
                         return $lista;
                        }
                        else
                        {
                         return 0;
                        } 
                    }
                }
                else{ 
                    return 2;
                }
                
            }
            
        }
        //Criptografia de dados.
        public function criptografar($dado)
        {
            //Criptografando informações do usuário com password hash
            $criptografado = password_hash($dado, PASSWORD_DEFAULT);
            return $criptografado;
        }
        public function insereDados($conexao, $nome, $email, $senha, $plano)
        {
            //Inserindo informações do usuário no banco de dados.
            $query = "INSERT INTO "
                    . "usuarios(nome_usuario, email_usuario, senha_usuario, pagamento_pendente, id_planofk)"
                    . "VALUES('$nome', '$email', '$senha', 1,$plano);";
            if($conexao->exec($query))
            {
                return 1;
            }
            else
            {
                return 0;
            }
            
        }
    }
?>
