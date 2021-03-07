<?php session_start() ?>
<?php include_once("./inc/header.php")?>

<h2 class="center">Création de votre compte</h2>

<form  action="traitement.php" method="post">
    <fieldset class="registerForm">
        <legend>Mon profil</legend>
        <label for="prenom">Prenom:</label><input type="text" name="prenom" id="prenom">
        <label for="nom">Nom:</label><input type="text" name="nom" id="nom">
        <br>

        <label for="courriel">Courriel:</label><input type="email" name="courriel" id="courriel">
        <label for="password">Mot de passe:</label><input type="password" name="password" id="password">
    </fieldset>

    <fieldset class="registerForm">
    <legend>Coordonnees</legend>
        <label for="pays">Pays:</label><input type="text" name="pays" id="pays">
        <br>
        <label for="noPorte"># porte:</label><input type="text" name="noPorte" id="noPorte">
        <label for="rue">Rue::</label><input type="text" name="rue" id="rue">
        <br>
        <label for="ville">Ville:</label><input type="text" name="ville" id="ville">
        <label for="province">Province:</label><input type="text" name="province" id="province">
        <br>
        <label for="codePostal">Code postal:</label><input type="text" name="codePostal" id="codePostal">
        <br>

        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="maison">Maison</option>
            <option value="bureau">Bureau</option>
            <option value="mobile">Mobile</option>
            <option value="autre">Autre</option>
        </select>

        <label for="telephone">Telephone:</label><input type="text" name="telephone" id="telephone">
    </fieldset>

    <fieldset class="registerForm" id="constructeurForm">
        <legend>Informations sur le constructeur</legend>
        <label for="paysDelivrance">Pays de délivrance:</label>
        <select name="paysDelivrance" id="paysDelivrance">
            <option value="Canada">Canada</option>
            <option value="États-unis">États-Unis</option>
            <option value="France">France</option>
        </select>
        <label for="naissance">Date de naissance:</label><input type="date" name="naissance" id="naissance">
        <br>
        <label for="noPermis">Numéro de permis: </label><input type="text" name="noPermis" id="noPermis">
        <label for="expired">Date d'expiration:</label><input type="date" name="expired" id="expired">
    </fieldset>
        <fieldset class="registerForm">
        <legend>Préférences</legend> 
        <input type="checkbox" name="promotion" id="promotion"><label name="promotion">Je souhaite recevoir les promotions par courriel.</label>
        <input type="checkbox" name="modalite" id="modalite"><label name="modalite">J'accepte les modalités.</label>
        <br>
        <input type="hidden" name="action" value="inscription">
        <input type="submit" value="Créer le compte" id="regSubmit">
    </fieldset>
</form>

<?php include_once("./inc/footer.php")?>