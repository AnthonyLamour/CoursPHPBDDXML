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

	<!--titre principale de la page-->
    <h1>Création de JSON depuis du javascript</h1>

	<!--fieldset contenant le formulaire de la page-->
    <fieldset id="MainFieldset">
		<!--légende du formulaire-->
        <legend>
            Formulaire de test JSON
        </legend>
		<!--formulaire de la page-->
        <form id="MainFormulaire" method="GET">
			<!--label du select d'arme-->
            <label for="SelectedWeapon">Choisissez une arme :</label>
            <!--select d'arme-->
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
                    
					//requête sql permettant de récupérer toutes les armes
                    $sql = "SELECT * FROM ARME";
					//pour chaque résultat
                    foreach($conn->query($sql) as $Arme){
                        //créer une option du select
						echo '<option value = "'.$Arme["NOMARME"].'">'.$Arme["NOMARME"].'</option>';
                    }
                ?>
            </select>
			<!--bouton permettant de valider le formulaire-->
            <input type="button" id="Envoi" value="Valider" onclick="InterrogerBDD()" />
        </form>
    </fieldset>

    <br/>
	<!--div contenant le résultat de la requête sql-->
    <div id="MainContent2">

    </div>

	<!--script javascript-->
    <script>
		//création d'une variable permettant de manipuler le div de résultat
        var MainContent = document.getElementById("MainContent2");

		//fonction appeller lorsque le bouton est clicker
        function InterrogerBDD() {
			//reset du contenu du div de résultat
            MainContent.innerHTML="";
			//création d'un nouveau tableau HTML
            var newTable = document.createElement("table");
			//création de l'objet JSON
            var SELECTEDWEAPON={"SELECTEDWEAPON": document.getElementById("SelectedWeapon").value};
			//transformation du JSON en chaine pour pouvoir le passer en paramètre
            var dbParam = JSON.stringify(SELECTEDWEAPON);
			//création d'une requête XMLHttpRequest
            var xhttp = new XMLHttpRequest();
			//fonction appeller à l'envoie de la requête
            xhttp.onreadystatechange = function () {
				//si la requête est prête
                if (this.readyState == 4 && this.status == 200) {
					//récupération et parsage du résultat en JSON
                    var json = JSON.parse(this.responseText);
					//pour chaque élément du résultat
                    for (var i = 0; i < json.length; i++) {
						//création d'une nouvelle ligne dans le tableau
                        var newLine = document.createElement("tr");
						//création d'une nouvelle colone dans le tableau
                        var newCol = document.createElement("td");
						//mise en place de l'attribut class de la case
                        newCol.setAttribute("class", "TextCadre");
						//remplissage de la case
                        newCol.innerHTML = json[i].NOMCLASSE;
						//ajout de la case à la ligne
                        newLine.appendChild(newCol);
						//création d'une nouvelle colone dans le tableau
                        newCol = document.createElement("td");
						//mise en place de l'attribut class de la case
                        newCol.setAttribute("class", "TextCadre");
						//remplissage de la case
                        newCol.innerHTML = json[i].WEAPON_A;
                        newLine.appendChild(newCol);
						//création d'une nouvelle colone dans le tableau
                        newCol = document.createElement("td");
						//mise en place de l'attribut class de la case
                        newCol.setAttribute("class", "TextCadre");
						//remplissage de la case
                        newCol.innerHTML = json[i].WEAPON_B;
						//ajout de la case à la ligne
                        newLine.appendChild(newCol);
						//création d'une nouvelle colone dans le tableau
                        newCol = document.createElement("td");
						//mise en place de l'attribut class de la case
                        newCol.setAttribute("class", "TextCadre");
						//remplissage de la case
                        newCol.innerHTML = json[i].WEAPON_C;
						//ajout de la case à la ligne
                        newLine.appendChild(newCol);
						//création d'une nouvelle colone dans le tableau
                        newCol = document.createElement("td");
						//mise en place de l'attribut class de la case
                        newCol.setAttribute("class", "TextCadre");
						//remplissage de la case
                        newCol.innerHTML = json[i].MAX_LEVEL;
						//ajout de la case à la ligne
                        newLine.appendChild(newCol);
						//ajout de la ligne au tableau
                        newTable.appendChild(newLine);
                    }
					//ajout du tableau dans le div
                    MainContent.appendChild(newTable);
                }
            };
            //ouverture du fichier XML
            xhttp.open("POST", "Get_Classe_From_WeaponPOST.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //envoi de la requète
            xhttp.send("x="+dbParam);
            

        }


    </script>

    <!--footer-->
    <footer>
        <!--paragraphe de footer-->
        <p>Anthony LAMOUR étudiant en Master 2 à Ludus Académie</p>
    </footer>
</body>

</html>