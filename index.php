<?php 

require_once 'Contato.php';

$contato = new Contato;

$contato->adicionar('pedro.magalhaes123@gmail.com', 'Pedro Magalhães da Silva');

echo $contato->getNome('pedro.magalhaes123@gmail.com');

echo '<br />';
echo '<hr />';

$contato->editar('Gustavo Massacration', 'gustavo.silva217@fatec.sp.gov.br');

$contato->excluir('pedro.magalhaes123@gmail.com');

foreach ($contato->getAll() as $contato) {

    echo 'Nome: '.$contato['nome'].'<br />';
    echo 'E-mail: '.$contato['email'].'<br /><br />';

}
