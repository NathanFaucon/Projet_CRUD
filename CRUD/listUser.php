<?php session_start(); 
if($_SESSION['isAdmin']!=1){
    header('Location: index.php');
    exit();  
}
?>
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
                        if(!isset($_SESSION['email'])){
							echo "<div><a href='connexion.php'>Me connecter</a></div><br>
							<div><a href='inscription.php'>M'inscrire</a></div><br>";
						}
						else
						{
							if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
								echo "<div><a href='listUser.php'>Utilisateurs</a></div><br>";
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
        <div>
            <?php 
                try{
                    $bdd=new PDO('mysql:host=localhost; dbname=projet_crud; charset=utf8', 'root', 'root');
                    $listeUsers = $bdd->prepare('SELECT * FROM users');
                    $listeUsers->execute();
                    $users=$listeUsers->fetchAll();
                    echo "<table>
                    <tr>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Moderation</th>
                    </tr>";
                    foreach ($users as $user) 
                    {
                        echo "<tr>
                        <td><input type='hidden' value='".$user['id']."' name='id'>".$user['email']."</td>
                        <td>".$user['isAdmin']."</td>";
                        
                        if($user['isAdmin']!=1)
                        {
                            echo "<form action='editUser.php' method='POST'>
                            <td><button type='submit' value='".$user['id']."' name='id' class='bouton'>Modifier</button><br></form>
                            <form action='deleteUser.php' method='POST'>
                            <button type='submit' value='".$user['id']."' name='id' class='bouton'>Supprimer</button></td>
                            </tr></form>";
                        }
                        
                    
                    }
                    echo "</table>";
                }
                catch(PDOException $e)
                {
                    echo "<br>". $sql . "<br>" . $e->getMessage();
                }
                $bdd=null;
            ?>

    </body>
</html>