<?php session_start() ?>

<?php include_once("./inc/header.php")?>

<?php 
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'error')
    {
        echo "<h2 class=\"center\"> Erreur d'authentification. </h2><br>"; 
    }
?>
    <form action="./traitement.php?action=connected" method="post">
        <fieldset class="loginFieldset">
            <div class="loginContainer">
                <label for="username">Nom d'utilisateur:</label><input type="text" name="username" id="username">
                <br>
                <label for="sessPassword">Mot de passe:</label><input type="password" name="sessPassword" id="sessPassword">
                <br>
                <input type="hidden" name="action" value="login">
                <input type="submit" value="Se connecter" id="loginSubmit">
            </div>
        </fieldset>
    </form>

<?php include_once("./inc/footer.php")?>