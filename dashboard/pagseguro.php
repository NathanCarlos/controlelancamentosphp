<?php
include_once '../classes/Usuario.php';
include_once '../conexao.php';
$usuario = new Usuario();
//A variável sandbox é para informar se está funcionando em ambiente de teste ou produção.
$sandbox = true;

//Informações da Empresa.
$pagseguro['email'] = 'alphatechnologies3241@gmail.com';

$pagseguro['token'] = 'BD15D1E1F90D498CBD817A369F25F483'; //token de ambiente de teste
/*$pagseguro['token'] = '3F4E06EC33CC4086B92C5F437C94CB3A'; //token ambiente de produção*/

//Moeda.
$pagseguro['currency'] = 'BRL';

//Informações do Produto.
$pagseguro['itemId1'] = '1';
$pagseguro['itemDescription1'] = 'Teste';
$pagseguro['itemAmount1'] = '2.50';
$pagseguro['itemQuantity1'] = 1;
$pagseguro['itemWeight1'] = 0;

/*Código de Referência(Código do pedido)*/
$pagseguro['reference'] = '1';

/*Cadastro de Cliente*/
//Nome
$pagseguro['senderName'] = 'Ambiente Teste';
//Cpf
$pagseguro['CPF'] = '48679899836';
//Data de nascimento.
$pagseguro['senderBornDate'] = '01/01/2000' ;
//DDD
$pagseguro['senderAreaCode'] = '11';
//Número do celular
$pagseguro['senderPhone'] = '963420633';
//Email
$pagseguro['senderEmail'] = 'nathan324116@gmail.com';
//Tipo de frete, no caso 3 é grátis.
$pagseguro['shippingType'] = '3';
//Endereço
$pagseguro['shippingAddressStreet'] = 'Endereço';
//Número
$pagseguro['shippingAddressNumber'] = '210';
//Complemento
$pagseguro['shippingAddressComplement'] = 'Complemento';
//Bairro
$pagseguro['shippingAddressDistrict'] = 'Bairro';
//Cep
$pagseguro['shippingAddressPostalCode'] = '07134625';
//Cidade
$pagseguro['shippingAddressCity'] = 'Cidade';
//Estado
$pagseguro['shippingAddressState'] = 'SP';
//País
$pagseguro['shippingAdressCountry'] = 'BRA';

/*URL de Redirecionamento e Notificação*/
$pagseguro['redirectURL'] = 'http://localhost/ongest/index.php';
$pagseguro['notificationURL'] = 'http://localhost/ongest/dashboard/retorno.php';

/*Enviar Pedido*/
if($sandbox==true){
    //Link do webservice de homologação.
    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/';
}
else{
    //Link do webservice de produção.
    $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';
}
//Construindo a query do array pagseguro.
$pagseguro = http_build_query($pagseguro);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $pagseguro);

//Recebendo execução do protocolo http e mandando para a variável xml.
$xml = curl_exec($curl);
//Se ele não encontrar as informações do email e do token ele vai exibir o erro.
if($xml == 'Unauthorized'){
    echo 'Erro de Autenticação';
    exit;
}
//Fechado conexão.
curl_close($curl);

//Lendo o xml recebido.
$xml1 = simplexml_load_string($xml);

//Se tiver algum errro ele retorna dados inváldos.
if(count($xml1->error) > 0 ){
    echo 'Dados Inválidos';
}

//Se o ambiente de homologação estiver ativo, ele utilzia essa url, se não, utiliza a do else.
if($sandbox == true){
    //Link de homologação.
    header('Location: https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='. $xml1->code);
}
else{
    //Link de produção.
    header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code='. $xml1->code);
}
?>