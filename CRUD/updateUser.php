<?php session_start(); ?>
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
        <span for="colFormspan">Cette adresse email est déjà utilisée</span>
        </div>
		
    </body>
</html>

<?php
    try{
        $flag=0;
        $bdd=new PDO('mysql:host=localhost; dbname=projet_crud; charset=utf8', 'root', 'root');
        $listeUsers = $bdd->prepare('SELECT * FROM users');
        $listeUsers->execute();					
        $users=$listeUsers->fetchAll();			//on récup tous les users
        foreach ($users as $user) 
        {
            if ((strcmp($user['email'],$_POST['email'])==0))	//si l'adresse mail est déjà activée, flag à 1
            {
                $flag=1;
            } 
        }
        if ($flag==0){          //si l'adresse mail n'est pas utilisée, on modifie les infos de l'user correspondant
            $sql="UPDATE users SET email='".$_POST['email']."' WHERE id=".$_POST['id'];
            $prep = $bdd->prepare($sql);
            $prep->execute();
            echo $prep->rowCount() . " records UPDATED successfully<br>Modification effectuée";
            header('Location: listUser.php');   //et on redirige vers la page d'admin
            exit();
        }
    }
    catch(PDOException $e)
    {
        echo "<br>". $sql . "<br>" . $e->getMessage();
    }
    $bdd=null;  
?>