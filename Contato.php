<?php 

class Contato
{
	
	private PDO $pdo;
	
	public function __construct() 
	{
		$this->pdo = new PDO('mysql:host=localhost;dbname=crudoo', 'root', '');
	}
	
	public function adicionar(string $email, string $nome = '') : bool 
	{
		if ($this->existeEmail($email)) {
			return false;
		}	
		
		$sql = 'INSERT INTO contatos (nome, email) VALUES (:nome, :email)';
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':nome', $nome);
		$sql->bindValue(':email', $email);
		
		$sql->execute();
		
		return true;
	}
	
	public function getNome(string $email) : string
	{
		$nome = '';
		
		$sql = 'SELECT nome FROM contatos WHERE email = :email';
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':email', $email);
		
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$nome = $sql->fetch()['nome'];
		}
		
		return $nome;
	}
	
	public function getAll() : array 
	{
		$sql = 'SELECT * FROM contatos';
		$sql = $this->pdo->query($sql);
		
		return $sql->fetchAll();
	}

	public function editar(string $nome, string $email) : bool
	{	
		if ($this->existeEmail($email)) {
			$sql = 'UPDATE contatos SET nome = :nome  WHERE email = :email';
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
	
			$sql->execute();

			return true;
		}

		return false;

	}

	public function excluir(string $email) : bool 
	{
		if ($this->existeEmail($email)) {
			
			$sql = 'DELETE FROM contatos WHERE email = :email';
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':email', $email);

			$sql->execute();

			return true;
		}

		return false;
 	}
	
	private function existeEmail(string $email) : bool 
	{
		
		$sql = 'SELECT * FROM contatos WHERE email = :email';
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':email', $email);
		
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			return true;
		}
		
		return false;
		
	}
	
}
