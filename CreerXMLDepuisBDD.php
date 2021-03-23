<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <!--titre de la page-->
    <title>XML depuis BDD</title>
    <!--lien vers le CSS de la page-->
    <link rel="stylesheet" href="CSS/Style.css" />
    <!--icone de la page-->
    <link rel="icon" href="Images/icone.png">
</head>

<body>
    <!--menu de navigation entre les pages-->
    <nav>
        <!--titre du menu de navigation-->
        <h3>Menu de navigation :</h3>
        <!--lien vers la page d'accauil-->
        <a href="index.php" class="navLink" >Acceuil</a>
    </nav>
    
    <!--titre de la page-->
    <h1>Création d'un fichier XML à partir d'une BDD :</h1>

    <!--contenu principale-->
    <div id="MainContent">
        <textarea id="recupFichier" rows="50" cols="70"></textarea><br/>
        <input type="button" id="btnRecupFichier" onclick="recupererFichier();" value="récupérer le fichier"/>
    </div>

    <!--script js-->    
    <script>
        //variable de type XMLHttpRequest
        var xhttp = new XMLHttpRequest;

        //création de sa fonction onreadystatechange
        xhttp.onreadystatechange = function () {
            document.getElementById("recupFichier").innerHTML=this.responseText;
        }
        
        function recupererFichier(){
            //ouverture du fichier XML
            xhttp.open("GET", "Uniter_DOM.xml", true);
            //envoi de la requète
            xhttp.send();
        }
    </script>

    <!--php-->
    <?php
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

		//création de l'objet PHP Unit
        class Unit{
			//ID de l'unité
			private $ID;
			//Nom de l'unité
			private $NOM;
			//Date de naissance de l'unité
			private $DATEDENAISSANCE;
			//Nom de la classe de l'unité
			private $NOMCLASSE;

			//fonction permettant de setter l'ID
			function Set_ID($newID){
				$this->ID=$newID;
			}

			//fonction permettant de setter le nom
			function Set_NOM($newNOM){
				$this->NOM=$newNOM;
			}
			
			//fonction permettant de setter la date de naissance
			function Set_DATEDENAISSANCE($newDATEDENAISSANCE){
				$this->DATEDENAISSANCE=$newDATEDENAISSANCE;
			}

			//fonction permettant de setter le nom de la classe
			function Set_NOMCLASSE($newNOMCLASSE){
				$this->NOMCLASSE=$newNOMCLASSE;
			}

			//fonction permettant de récupérer l'ID
			function Get_ID(){
				return $this->ID;
			}

			//fonction permettant de récupérer le nom
			function Get_NOM(){
				return $this->NOM;
			}
			
			//fonction permettant de récupérer la date de naissance
			function Get_DATEDENAISSANCE(){
				return $this->DATEDENAISSANCE;
			}

			//fonction permettant de récupérer le nom de la classe
			function Get_NOMCLASSE(){
				return $this->NOMCLASSE;
			}

			//fonction permettant d'initialiser une unité entière
			function Init_Unit($newID,$newNOM,$newDATEDENAISSANCE,$newNOMCLASSE){
				$this->Set_ID($newID);
				$this->Set_NOM($newNOM);
				$this->Set_DATEDENAISSANCE($newDATEDENAISSANCE);
				$this->Set_NOMCLASSE($newNOMCLASSE);
			}
		}

		//création de l'objet PHP Classe
		class Classe{
			//Nom de la classe
			private $NOMCLASSE;
			//Première arme de la classe
			private $WEAPON_A;
			//Deuxième arme de la classe
			private $WEAPON_B;
			//Troisième arme de la classe
			private $WEAPON_C;
			//Level maximum de la classe
			private $MAX_LEVEL;

			//fonction permettant de setter le nom de la classe
			function Set_NOMCLASSE($newNOMCLASSE){
				$this->NOMCLASSE=$newNOMCLASSE;
			}

			//fonction permettant de setter la première arme
			function Set_WEAPON_A($newWEAPON_A){
				$this->WEAPON_A=$newWEAPON_A;
			}

			//fonction permettant de setter la deuxième arme
			function Set_WEAPON_B($newWEAPON_B){
				$this->WEAPON_B=$newWEAPON_B;
			}

			//fonction permettant de setter la troisième arme
			function Set_WEAPON_C($newWEAPON_C){
				$this->WEAPON_C=$newWEAPON_C;
			}

			//fonction permettant de setter le level maximum de la classe
			function Set_MAX_LEVEL($newMAX_LEVEL){
				$this->MAX_LEVEL=$newMAX_LEVEL;
			}

			//fonction permettant de récupérer le nom de la classe
			function Get_NOMCLASSE(){
				return $this->NOMCLASSE;
			}

			//fonction permettant de récupérer le nom de la première arme
			function Get_WEAPON_A(){
				return $this->WEAPON_A;
			}

			//fonction permettant de récupérer le nom de la deuxième arme
			function Get_WEAPON_B(){
				return $this->WEAPON_B;
			}

			//fonction permettant de récupérer le nom de la troisième arme
			function Get_WEAPON_C(){
				return $this->WEAPON_C;
			}

			//fonction permettant de récupérer le level maximum
			function Get_MAX_LEVEL(){
				return $this->MAX_LEVEL;
			}

			//fonction permettant d'initialiser une classe entière
			function Init_Classe($newNOMCLASSE,$newWEAPON_A,$newWEAPON_B,$newWEAPON_C,$newMAX_LEVEL){
				$this->Set_NOMCLASSE($newNOMCLASSE);
				$this->Set_WEAPON_A($newWEAPON_A);
				$this->Set_WEAPON_B($newWEAPON_B);
				$this->Set_WEAPON_C($newWEAPON_C);
				$this->Set_MAX_LEVEL($newMAX_LEVEL);
			}
		}

		//déclaration d'un tableau d'unités
		$TabUnit = array();

		//création d'une varaible servant à créer la prochaine unité
		$tmpUnit;

		//préparation de la requète permettant de récupérer les unités de la BDD
        $sql="SELECT * FROM `Unit` ORDER by `ID`";
		//pour chaque résultat
		foreach($conn->query($sql) as $row){
			//création d'un nouvel objet Unit
			$tmpUnit = new Unit();
			//set de l'unité basé sur le résultat de la requète
			$tmpUnit->Init_Unit($row['ID'],$row['NOM'],$row['DATEDENAISSANCE'],$row['NOMCLASSE']);
			//ajout de l'unité dans le tableau
			array_push($TabUnit,$tmpUnit);
		}

		//déclaration d'un tableau de classe
		$TabClasse = array();

		//création d'une varaible servant à créer la prochaine classe
		$tmpClasse;

		//préparation de la requète permettant de récupérer les unités de la BDD
        $sql="SELECT * FROM `Classe` ORDER by `NOMCLASSE`";
		//pour chaque résultat
		foreach($conn->query($sql) as $row){
			//création d'un nouvel objet Classe
			$tmpClasse = new Classe();
			//set de la classe basé sur le résultat de la requète
			$tmpClasse->Init_Classe($row['NOMCLASSE'],$row['WEAPON_A'],$row['WEAPON_B'],$row['WEAPON_C'],$row['MAX_LEVEL']);
			//ajout de l'unité dans le tableau
			array_push($TabClasse,$tmpClasse);
		}
        //création du nouveau document
        $document = new DomDocument('1.0','utf8');
        //set up du document
        $document->preserveWhiteSpace=false;
        $document->formatOutput=true;
        //création de la racine
        $lesUnites = $document->createElement("Unites");
        //ajout de la racine au document
        $document->appendChild($lesUnites);
        //pour chaque unités du tableau
        foreach($TabUnit as $unite){
            //création d'un élément unité
            $tmpUnit = $document->createElement("Unite");
            //ajout d'un attribut id à l'unité
            $tmpUnit->setAttribute("id",$unite->Get_ID());
			//ajout de l'élément IdUnit
			$newElement = $document->createElement("IdUnit");
			$newElement->nodeValue=htmlspecialchars($unite->Get_ID());
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément NOM
			$newElement = $document->createElement("Nom");
			$newElement->nodeValue=htmlspecialchars($unite->Get_NOM());
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément DATEDENAISSANCE
			$newElement = $document->createElement("Date_de_naissance");
			$newElement->nodeValue=htmlspecialchars($unite->Get_DATEDENAISSANCE());
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément NOMCLASSE
			$newElement = $document->createElement("Nom_classe");
			$newElement->nodeValue=htmlspecialchars($unite->Get_NOMCLASSE());
			$tmpUnit->appendChild($newElement);
			//récupérer de l'index de la classe dans le tableau de Classe
			$indexClasse=null;
			$cpt=0;
			while($indexClasse==null && $cpt<count($TabClasse)){
				if($unite->Get_NOMCLASSE() == $TabClasse[$cpt]->Get_NOMCLASSE()){
					$indexClasse=$cpt;
				}
				$cpt=$cpt+1;
			}
			//ajout de l'élément WEAPON_A
			$newElement = $document->createElement("Weapon_A");
			$newElement->nodeValue=$TabClasse[$indexClasse]->Get_WEAPON_A();
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément WEAPON_B
			$newElement = $document->createElement("Weapon_B");
			$newElement->nodeValue=htmlspecialchars($TabClasse[$indexClasse]->Get_WEAPON_B());
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément WEAPON_C
			$newElement = $document->createElement("Weapon_C");
			$newElement->nodeValue=htmlspecialchars($TabClasse[$indexClasse]->Get_WEAPON_C());
			$tmpUnit->appendChild($newElement);
			//ajout de l'élément Max_level
			$newElement = $document->createElement("Max_level");
			$newElement->nodeValue=htmlspecialchars($TabClasse[$indexClasse]->Get_MAX_LEVEL());
			$tmpUnit->appendChild($newElement);
            //ajout de l'étudiant au document
            $lesUnites->appendChild($tmpUnit);
        }
        //save du fichier
        $document->save("Unites_DOM.xml");
    ?>