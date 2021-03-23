<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--titre de la page-->
    <title>BDD depuis XML</title>
    <!--lien vers le CSS de la page-->
    <link rel="stylesheet" href="CSS/Style.css" />
    <!--icone de la page-->
    <link rel="icon" href="Images/icone.png">
</head>

<!--contenu de la page-->
<body>
    <!--menu de navigation entre les pages-->
    <nav>
        <!--titre du menu de navigation-->
        <h3>Menu de navigation :</h3>
        <!--lien vers la page d'accauil-->
        <a href="index.html" class="navLink" >Acceuil</a><br/>
        <!--lien vers la page de création de XML depuis une BDD-->
        <a href="CreerXMLDepuisBDD.php" class="navLink" >Création d'XML depuis une BDD</a><br/>
        <!--lien vers la page de création de JSON depuis du JS-->
        <a href="CreerJSONavecJS.html" class="navLink" >Création de JSON depuis JS</a>
    </nav>
    
    <!--titre de la page-->
    <h1>Ajout de données depuis un fichier XML dans une BDD :</h1>

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

        //lecture du fichier Ajout_XML
		$Ajouts=simplexml_load_file("Ajout_XML.xml");
        //pour chaque éléments de $Ajouts
        foreach($Ajouts as $Ajout){
            //début de l'instruction XML
            $sql = "Insert into ".$Ajout->getName()."(";
            //ajout du nom de l'élément dans la requète
            foreach($Ajout as $Element){
                $sql = $sql.$Element->getName().",";
            }
            //remplacement de la dernière , par une )
            $sql = substr_replace($sql,")",strlen($sql)-1);
            //ajout de l'instruction values
            $sql = $sql." values(";
            //pour chaque élément de $Ajout
            foreach($Ajout as $Element){
                //en fonction du type d'information
                switch ($Element['type']){
                    //si chaine ajout à la requète sql avec ''
                    case "string":
                        $sql = $sql."'".$Element."',";
                        break;
                    //si entier ajout à la requète sql sans ''
                    case "int":
                        $sql = $sql.$Element.",";
                        break;
                }
            }
            //remplacement de la dernière , par );
            $sql = substr_replace($sql,");",strlen($sql)-1,2);
            //exécution de la requète
            $conn->query($sql);
        }
        
        echo"<div id=\"TabArme\">";
        echo"<table>";
        //préparation de la requète permettant de récupérer les unités de la BDD
        $sql="SELECT * FROM `Arme` ORDER by `NOMARME`";
        echo "<tr>";
        echo "<td class=\"TextCadre\">Nom de l'arme</td>";
        echo "</tr>";
		//pour chaque résultat
		foreach($conn->query($sql) as $row){
			echo "<tr>";
            echo "<td class=\"TextCadre\">".$row["NOMARME"]."</td>";
            echo "</tr>";
		}
        echo"</table>";
        echo"</div>";
        echo"<br/>;
        
        echo"<div id=\"TabClasse\">";
        echo"<table>";
        //préparation de la requète permettant de récupérer les unités de la BDD
        $sql="SELECT * FROM `CLASSE` ORDER by `NOMCLASSE`";
        echo "<tr>";
        echo "<td class=\"TextCadre\">Nom de la classe</td>";
        echo "<td class=\"TextCadre\">Arme 1</td>";
        echo "<td class=\"TextCadre\">Arme 2</td>";
        echo "<td class=\"TextCadre\">Arme 3</td>";
        echo "<td class=\"TextCadre\">Niveau max</td>";
        echo "</tr>";
		//pour chaque résultat
		foreach($conn->query($sql) as $row){
			echo "<tr>";
            echo "<td class=\"TextCadre\">".$row["NOMCLASSE"]."</td>";
            echo "<td class=\"TextCadre\">".$row["WEAPON_A"]."</td>";
            echo "<td class=\"TextCadre\">".$row["WEAPON_B"]."</td>";
            echo "<td class=\"TextCadre\">".$row["WEAPON_C"]."</td>";
            echo "<td class=\"TextCadre\">".$row["MAX_LEVEL"]."</td>";
            echo "</tr>";
		}
        echo"</table>";
        echo"</div>";
        echo"<br/>;

        echo"<div id=\"TabUnit\">";
        echo"<table>";
        //préparation de la requète permettant de récupérer les unités de la BDD
        $sql="SELECT * FROM `UNIT` ORDER by `NOM`";
        echo "<tr>";
        echo "<td class=\"TextCadre\">Nom</td>";
        echo "<td class=\"TextCadre\">Date de naissance</td>";
        echo "<td class=\"TextCadre\">Classe de base</td>";
        echo "</tr>";
		//pour chaque résultat
		foreach($conn->query($sql) as $row){
			echo "<tr>";
            echo "<td class=\"TextCadre\">".$row["NOM"]."</td>";
            echo "<td class=\"TextCadre\">".$row["DATEDENAISSANCE"]."</td>";
            echo "<td class=\"TextCadre\">".$row["NOMCLASSE"]."</td>";
            echo "</tr>";
		}
        echo"</table>";
        echo"</div>";
    ?>
    
    <!--footer-->
    <footer>
        <!--paragraphe de footer-->
        <p>Anthony LAMOUR étudiant en Master 2 à Ludus Académie</p>
    </footer>

</body>

</html>