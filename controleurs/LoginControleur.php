<?php
    // on appelle la vue du formulaire
    require_once("./vues/LoginVue.php");
    
    // on appelle le mdoèle pour la table personnel
    require_once("./modeles/PersonnelModele.php");


    function ctlFormLogin(){
        if (isset($_POST["login_submit"])) {
            if (
                isset($_POST["login"]) && 
                strlen($_POST["login"]) > 0 &&
                isset($_POST["MDP"]) &&
                strlen($_POST["MDP"]) > 0
            ) {
                $personnel = getPersonnelByUsername($_POST["login"], $_POST["MDP"]);
                if(isset($personnel->NOM)){
                    $_SESSION["nom_personnel"] = $personnel->NOM;
                    $categorie = getCategorieById($personnel->IDCAT);
                    $_SESSION["categorie_personnel"] = $categorie->LIBELLECAT;

                    return; // TODO recharger la page;
                }else {
                    // => message d'erreur dans le formulaire;
                    return afficherFormulaireConnexion(true);
                }

            }
        }
        $vueFormLogin = afficherFormulaireConnexion();
        return $vueFormLogin;
    }
    
?>