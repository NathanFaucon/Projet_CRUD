<?php session_start() ?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css"/>
		<title>CRUD</title>
	</head>

	<body>
		<div class="menuprincipal d-flex flex-row">
			<div class="menu d-flex flex-column">
				<div class="home d-flex flex-column">
					<img src="home1.png">
				</div>

				<div class="leftbar d-flex flex-column">
					<div><a href='index.php'>Home</a></div><br>
					<?php 
						if(!isset($_SESSION['email'])){							//Si on n'est pas connecté, on nous montre les onglets de connexion
							echo "<div><a href='connexion.php'>Me connecter</a></div><br>
							<div><a href='inscription.php'>M'inscrire</a></div><br>";
						}
						else
						{								
							if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){		//Si on est connecté et qu'on est admin, on a accès à la page d'admin
								echo "<div><a href='listUser.php'>Administration</a></div><br>";
							}
							echo "<div><a href='logOut.php'>Se déconnecter</a></div><br>";
						}
					?>
				</div>
			</div>
			<div class="en-tete d-flex flex-grow-1">	
				<p class='titre-entete'>
			</div>
		</div>
		
        <div class="formulaire">
        <span for="colFormspan">Vous avez rentré des mauvais identifiants</span>        
        </div>
		
    </body>
</html>
<?php 
    try{
        $bdd=new PDO('mysql:host=localhost; dbname=projet_crud; charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
    $listeUsers = $bdd->prepare('SELECT * FROM users'); 
    $listeUsers->execute();
    $users=$listeUsers->fetchAll();     //récup des users
    foreach ($users as $user)           
    {       
        if ((strcmp($user['email'],$_POST['email'])==0) && (strcmp($user['password'],$_POST['pass'])==0))   //on vérifie s'il y a bien un couple email/password correspondant
        {
            $email_user=$user['email'];
            $isAdmin=$user['isAdmin'];
            $id_user=$user['id'];
            $_SESSION['email']=$email_user;         //si c'est le cas on crée les variables de session de l'user
            $_SESSION['isAdmin']=$isAdmin;
            $_SESSION['id_user']=$id_user;          
            header('Location: index.php');          //et on le redirige
            exit(); 
        } 
    }
?>