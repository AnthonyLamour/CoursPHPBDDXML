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

    //récupération et parsage de l'objet JSON
    $obj = json_decode($_GET["x"], false);
	//mise en place de la base de la requête sql permettant de récupérer toutes les classes pouvant utiliser l'arme sélectionnée
	$sql = $conn->prepare('SELECT *
                          FROM CLASSE
                          WHERE WEAPON_A = :MyWeapon1 OR WEAPON_B = :MyWeapon2 OR WEAPON_C = :MyWeapon3');
	//assignemant du premier paramètre
    $sql->bindParam(":MyWeapon1", $obj->SELECTEDWEAPON);
	//assignemant du deuxième paramètre
    $sql->bindParam(":MyWeapon2", $obj->SELECTEDWEAPON);
	//assignemant du troisième paramètre
    $sql->bindParam(":MyWeapon3", $obj->SELECTEDWEAPON);
	//exécution de la requête sql
    $sql->execute();
	//récupération du résultat de la requête sql
    $classe = $sql->fetchAll();
	//renvoi du résultat sous forme d'objet JSON
    echo json_encode($classe);
	
?>