<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta charset="utf-8" />
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
				}
			
			//affichage d'éventuelles erreurs
				catch(PDOExecption $e){
					printf("Echec de la connexion : %s\n", $e->getMessage());
					exit();
				}
			
			//renvoi de la connexion
				return $connexion;
		}
	    $conn = ConnecServ();
        var_dump($conn);
        $sql="SELECT * FROM `Unit` ORDER by `NOM`";
		foreach($conn->query($sql) as $row){
			echo "ID = ".$row['ID']." Nom = ".$row['NOM']." Date de naissance = ".$row['DATEDENAISSANCE']." Classe = ".$row['NOMCLASSE']."<br/>";
		}
        /*//création du nouveau document
        $document = new DomDocument();
        //set up du document
        $document->preserveWhiteSpace=false;
        $document->formatOutput=true;
        //création de la racine
        $lesEtudiants = $document->createElement("Etudiants");
        //ajout de la racine au document
        $document->appendChild($lesEtudiants);
        //pour chaque étudiant du tableau
        foreach($tabEtudiant as $num => $etud){
            //création d'un élément étudiant
            $etudiant = $document->createElement("Etudiant");
            //ajout d'un attribut id à l'étudiant
            $etudiant->setAttribute("id",$num);
            //pour chaque élément de cet étudiants
            foreach($etud as $key => $val){
                //ajout de l'élément à l'étudiant
                $newElement = $document->createElement($key);
                $newElement->nodeValue=htmlspecialchars($val);
                $etudiant->appendChild($newElement);
            }
            //ajout de l'étudiant au document
            $lesEtudiants->appendChild($etudiant);
        }
        //save du fichier
        $document->save("Etudiants_DOM.xml");*/
    ?>