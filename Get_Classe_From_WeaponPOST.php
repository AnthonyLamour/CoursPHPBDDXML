<?php

    header("Content-Type: application/json; charset=utf-8");
    //nom du serveur
	define('SERVEUR',"localhost");

	//nom de la base de données
	define('BASE',"FireEmblem_TPXML");

	//nom de l'utisateur
	define('USER',"root");

	//mot de passe
	define('PASSWD',"");

	//fonction permettant la connexion
	function ConnecServ(){
			
		//mise en place du script de connexion
			$dsn="mysql:dbname=".BASE.";host=".SERVEUR;
			
		//tentative de connexion à la base de données
			try{
				$connexion=new PDO($dsn,USER,PASSWD);
				$connexion->exec("set names utf8");
			}
			
		//affichage d'éventuelles erreurs
			catch(PDOExecption $e){
				printf("Echec de la connexion : %s\n", $e->getMessage());
				exit();
			}
			
		//renvoi de la connexion
			return $connexion;
	}
	//connexion à la BDD
	$conn = ConnecServ();
    
    $obj = json_decode($_POST["x"], false);
	$sql = $conn->prepare('SELECT *
                          FROM CLASSE
                          WHERE WEAPON_A = :MyWeapon1 OR WEAPON_B = :MyWeapon2 OR WEAPON_C = :MyWeapon3');
    $sql->bindParam(":MyWeapon1", $obj->SELECTEDWEAPON);
    $sql->bindParam(":MyWeapon2", $obj->SELECTEDWEAPON);
    $sql->bindParam(":MyWeapon3", $obj->SELECTEDWEAPON);
    $sql->execute();
    $classe = $sql->fetchAll();
    echo json_encode($classe);
	
?>