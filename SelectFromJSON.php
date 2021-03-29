<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<!--head de la page-->
<head>
    <!--encodage de la page-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--titre de la page-->
    <title>JSON depuis JS</title>
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
        <a href="index.html" class="navLink">Acceuil</a><br />
        <!--lien vers la page de création de XML depuis une BDD-->
        <a href="CreerXMLDepuisBDD.php" class="navLink">Création d'XML depuis une BDD</a><br />
        <!--lien vers la page d'ajout dans une BDD depuis un XML-->
        <a href="AjoutBDDXML.php" class="navLink">Ajout dans une BDD depuis XML</a>
    </nav>

    <h1>Création de JSON depuis du javascript</h1>

    <fieldset id="MainFieldset">
        <legend>
            Formulaire de test JSON
        </legend>
        <form id="MainFormulaire" method="GET">
            <label for="SelectedWeapon">Choisissez une arme :</label>
            <select id="SelectedWeapon">
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
                    
                    $sql = "SELECT * FROM ARME";
                    foreach($conn->query($sql) as $Arme){
                        echo '<option value = "'.$Arme["NOMARME"].'">'.$Arme["NOMARME"].'</option>';
                    }
                ?>
            </select>
            <input type="button" id="Envoi" value="Valider" onclick="InterrogerBDD()" />
        </form>
    </fieldset>

    <br/>
    <div id="MainContent2">

    </div>

    <script>
        var MainContent = document.getElementById("MainContent2");

        function InterrogerBDD() {
            MainContent.innerHTML="";
            var newTable = document.createElement("table");
            var SELECTEDWEAPON={"SELECTEDWEAPON": document.getElementById("SelectedWeapon").value};
            var dbParam = JSON.stringify(SELECTEDWEAPON);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var json = JSON.parse(this.responseText);
                    for (var i = 0; i < json.length; i++) {
                        var newLine = document.createElement("tr");
                        var newCol = document.createElement("td");
                        newCol.setAttribute("class", "TextCadre");
                        newCol.innerHTML = json[i].NOMCLASSE;
                        newLine.appendChild(newCol);
                        newCol = document.createElement("td");
                        newCol.setAttribute("class", "TextCadre");
                        newCol.innerHTML = json[i].WEAPON_A;
                        newLine.appendChild(newCol);
                        newCol = document.createElement("td");
                        newCol.setAttribute("class", "TextCadre");
                        newCol.innerHTML = json[i].WEAPON_B;
                        newLine.appendChild(newCol);
                        newCol = document.createElement("td");
                        newCol.setAttribute("class", "TextCadre");
                        newCol.innerHTML = json[i].WEAPON_C;
                        newLine.appendChild(newCol);
                        newCol = document.createElement("td");
                        newCol.setAttribute("class", "TextCadre");
                        newCol.innerHTML = json[i].MAX_LEVEL;
                        newLine.appendChild(newCol);
                        newTable.appendChild(newLine);
                    }
                    MainContent.appendChild(newTable);
                }
            };
            //ouverture du fichier XML
            xhttp.open("GET", "Get_Classe_From_Weapon.php?x=" + dbParam, true);
            //envoi de la requète
            xhttp.send();

        }


    </script>

    <!--footer-->
    <footer>
        <!--paragraphe de footer-->
        <p>Anthony LAMOUR étudiant en Master 2 à Ludus Académie</p>
    </footer>
</body>

</html>
