<!DOCTYPE html>
<?php

function test_input($data) : string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nameErr = $firstNameErr = $emailErr = $telErr = $messageErr = $subjectErr = "";
$name = $firstName = $email = $tel = $message = $subject = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $arrayOfValidValues = ["J'aime les patates", "Vive les oignons", "A mort les bananes", "Avocavirus"];

    if (empty($_POST["user_name"])) {
        $nameErr = "Veuillez entrer un nom";
    } else {
        $name = test_input($_POST["user_name"]);
    }

    if (empty($_POST["user_first_name"])) {
        $firstNameErr = "Veuillez entrer un prénom";
    } else {
        $firstName = test_input($_POST["user_first_name"]);
    }

    if (empty($_POST["user_email"])) {
        $emailErr = "Veuillez entrer une adresse email";
    } else if (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "E-mail invalide";
    } else {
        $email = test_input($_POST["user_email"]);
    }

    if (empty($_POST["user_phone"])) {
        $telErr = "Veuillez entrer un numéro de téléphone";
    } else {
        $tel = test_input($_POST["user_phone"]);
    }

    if (empty($_POST["user_subject"]) || !in_array($_POST["user_subject"], $arrayOfValidValues)) {
        $subjectErr = "Veuillez choisir un sujet";
    } else {
        $subject = test_input($_POST["user_subject"]);
    }

    if (empty($_POST["user_message"])) {
        $messageErr = "Veuillez entrer un message";
    } else {
        $message = test_input($_POST["user_message"]);
    }

    if ($nameErr . $firstNameErr . $emailErr . $telErr . $subjectErr . $messageErr === "") {
        session_start();
        $_SESSION["user_first_name"] = $firstName;
        $_SESSION["user_name"] = $name;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_phone"] = $tel;
        $_SESSION["user_subject"] = $subject;
        $_SESSION["user_message"] = $message;
        header("Location: http://" . $_SERVER["HTTP_HOST"] . "/thanks.php");
    }
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Formulaire</title>
    </head>
    <body>
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
            <div>
                <label  for="nom">Nom :</label>
                <input  type="text"  id="nom"  name="user_name" required>
                <span class="error"><?php echo $nameErr ?></span>
            </div>
            <div>
                <label  for="prenom">Prenom :</label>
                <input  type="text"  id="prenom"  name="user_first_name" required>
                <span class="error"><?php echo $firstNameErr ?></span>
            </div>
            <div>
                <label  for="courriel">Courriel :</label>
                <input  type="email"  id="courriel"  name="user_email" required>
                <span class="error"><?php echo $emailErr ?></span>
            </div>
            <div>
                <label  for="tel">Téléphone :</label>
                <input  type="tel"  id="tel"  name="user_phone" required>
                <span class="error"><?php echo $telErr ?></span>
            </div>
            <div>
                <label for="subject"> Sujet :
                    <select name="user_subject" required>
                        <option value="J'aime les patates" selected="selected">J'aime les patates</option>
                        <option value="Vive les oignons">Vive les oignons</option>
                        <option value="A mort les bananes">A mort les bananes</option>
                        <option value="Avocavirus">Avocavirus</option>
                    </select>
                </label>
                <span class="error"><?php echo $subjectErr ?></span>
            </div>
            <div>
                <label  for="message">Message :</label>
                <textarea  id="message"  name="user_message" required></textarea>
                <span class="error"><?php echo $messageErr ?></span>
            </div>
            <div >
                <button  type="submit" id="submit" name="submit">Envoyer votre message</button>
            </div>
         </form>
    </body>
</html>