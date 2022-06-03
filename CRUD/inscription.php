<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Inscription</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
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
				</p>
			</div>
		</div>

		<div class="formulaire">
			<h1>Formulaire d'inscripion</h1>
			<h5>Saisis les informations ci-dessous pour t'inscrire</h5>
		</div>
		<form action="checkInscription.php" method="post">
			
			<div class="formInput">
				<span for="colFormspan" class="col-sm-2 col-form-span">Email</span>
				<div class="col-sm-10">
					<input type="email" class="form-control" name="email" id="email" placeholder="Email">
				</div>
			</div>

			<div class="formInput">
				<span for="colFormspan" class="col-sm-2 col-form-span">Mot de passe</span>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="password" id="mdp" placeholder="Mot de passe">
				</div>
			</div>

			<div class="inscription">
				<button type="submit" id="buttonInscri">M'inscrire</button>
			</div>	
		</form>
	</body>
</html>