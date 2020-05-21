<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
</head>
    <body>
        <p>Merci <?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_name'] ?> de nous avoir contacté à propos de <?php echo $_SESSION['user_subject'] ?>.</p>
        <p>Un de nos conseiller vous contactera soit à l’adresse <?php echo $_SESSION['user_email'] ?> ou par téléphone au <?php echo $_SESSION['user_phone'] ?> dans les plus brefs délais pour traiter votre demande :</p>
        <p><?php echo $_SESSION['user_message'] ?></p>
        <?php
        session_unset();
        session_destroy();
        ?>
    </body>
</html>