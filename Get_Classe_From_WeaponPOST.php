<?php

    header("Content-Type: application/json; charset=utf-8");
    //nom du serveur
	define('SERVEUR',"localhost");

	//nom de la base de donn�es
	define('BASE',"FireEmblem_TPXML");

	//nom de l'utisateur
	define('USER',"root");

	//mot de passe
	define('PASSWD',"");

	//fonction permettant la connexion
	function ConnecServ(){
			
		//mise en place du script de connexion
			$dsn="mysql:dbname=".BASE.";host=".SERVEUR;
			
		//tentative de connexion � la base de donn�es
			try{
				$connexion=new PDO($dsn,USER,PASSWD);
				$connexion->exec("set names utf8");
			}
			
		//affichage d'�ventuelles erreurs
			catch(PDOExecption $e){
				printf("Echec de la connexion : %s\n", $e->getMessage());
				exit();
			}
			
		//renvoi de la connexion
			return $connexion;
	}
	//connexion � la BDD
	$conn = ConnecServ();
    
	//r�cup�ration et parsage de l'objet JSON
    $obj = json_decode($_POST["x"], false);
	//mise en place de la base de la requ�te sql permettant de r�cup�rer toutes les classes pouvant utiliser l'arme s�lectionn�e
	$sql = $conn->prepare('SELECT *
                          FROM CLASSE
                          WHERE WEAPON_A = :MyWeapon1 OR WEAPON_B = :MyWeapon2 OR WEAPON_C = :MyWeapon3');
    //assignemant du premier param�tre
	$sql->bindParam(":MyWeapon1", $obj->SELECTEDWEAPON);
	//assignemant du deuxi�me param�tre
    $sql->bindParam(":MyWeapon2", $obj->SELECTEDWEAPON);
	//assignemant du troisi�me param�tre
    $sql->bindParam(":MyWeapon3", $obj->SELECTEDWEAPON);
	//ex�cution de la requ�te sql
    $sql->execute();
	//r�cup�ration du r�sultat de la requ�te sql
    $classe = $sql->fetchAll();
	//renvoi du r�sultat sous forme d'objet JSON
    echo json_encode($classe);
	
?>