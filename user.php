<?php

class User
{

    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;
    private $bdd;

    public function __construct()
    {
        $bdd = mysqli_connect("localhost", "root", "", "classes");

        $this->bdd = $bdd;
    }
    public function register($login, $password, $confirm, $email, $firstname, $lastname)
    {
        $bdd = $this->bdd;

        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $confirm = htmlspecialchars($confirm);
        $email = htmlspecialchars($email);
        $firstname = htmlspecialchars($firstname);
        $lastname = htmlspecialchars($lastname);

        $login = trim($login);
        $password = trim($password);
        $confirm = trim($confirm);
        $email = trim($email);
        $firstname = trim($firstname);
        $lastname = trim($lastname);


        $req = "SELECT * FROM utilisateurs WHERE email = '$email";
        $query = mysqli_query($bdd, $req);

        if (!empty($login) && !empty($password) && !empty($confirm) && !empty($email) && !empty($firstname) && !empty($lastname)) {
            if (mysqli_num_rows($query) == 0) {
                if ($password === $confirm) {
                    $insert = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login, $password, $email, $firstname, $lastname')";
                    $query = mysqli_query($bdd, $insert);
                    header('Location:testing.php');
                } else {
                    echo "Les mots de passes doivent être les mêmes.";
                }
            } else {
                echo "Cette email existe déjà, veuillez en choisir un autre";
            }
        } else {
            echo "Veuillez remplir tout les champs pour procéder à l'inscription";
        }
    }
    public function connect($login, $password)
    {
        $bdd = $this->bdd;
        session_start();
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        $login = trim($login);
        $password = trim($password);

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $req = "SELECT * FROM utilisateurs WHERE login = $login";
        $query = mysqli_query($bdd, $req);
        $rows = mysqli_num_rows($query);
        if (!empty($_POST['login']) && !empty('password')) {
            if ($rows == 1) {
                if (password_verify($password, $passwordHash)) {
                    $_SESSION['id'] = $this->id;
                    $_SESSION['login'] = $this->login;
                    header('Location:testing.php');
                } else {
                    echo "Login ou mot de passe incorrect";
                }
            } else {
                echo "Login ou mot de passe incorrect";
            }
        } else {
            echo "Veuillez remplir tout les champs";
        }
    }
    public function disconnect()
    {
        $bdd = $this->bdd;
        session_destroy();
        header('Location:testing.php');
    }
    public function delete()
    {
        session_start();
        $bdd = $this->bdd;
        $id = $_SESSION['id'];
        $req = "DELETE * FROM utilisateurs WHERE id = '$id'";
        mysqli_query($bdd, $req);
        session_destroy();
    }
    public function update($login, $password, $email, $firstname, $lastname)
    {
        $bdd = $this->bdd;
        session_start();
        $id = $_SESSION['id'];
        $req = 'UPDATE utilisateurs SET login = $login, password = $password, email = $email, firstname = $firstname, lastname = $lastname WHERE id = $id';
        mysqli_query($bdd, $req);
    }
    public function isConnected()
    {
        if (!empty($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllInfos() {
        $bdd = $this->bdd; 
        session_start();
        $id = $_SESSION['id'];
        $req = 'SELECT * FROM utilisateurs WHERE id = $id';
        $query = mysqli_query($bdd, $req);
        $fetch = mysqli_fetch_all($query);
        $login = $fetch['login'];
        $email =  $fetch['email'];
        $firstname =  $fetch['firstname'];
        $lastname = $fetch['lastname'];
        if (isset($id)) {
            echo "<table>
                <tr>id</tr>
                <td>$id</td>
                <tr>login</tr>
                <td>$login</td>
                <tr>password</tr>
                <td>*******</td>
                <tr>email</tr>
                <td>$email</td>
                <tr>firstname</tr>
                <td>$firstname</td>
                <tr>lastname</tr>
                <td>$lastname</td>
            </table>";
        }
    }
    public function getLogin() {
        $bdd = $this->bdd; 
        session_start();
        $id = $_SESSION['id'];
        $req = 'SELECT * FROM utilisateurs WHERE id = $id';
        $query = mysqli_query($bdd, $req);
        if ($fetch = mysqli_fetch_all($query)) {
            $login = $fetch['login'];
            return "$login";
        }
    }
    public function getEmail() {
        $bdd = $this->bdd; 
        session_start();
        $id = $_SESSION['id'];
        $req = 'SELECT * FROM utilisateurs WHERE id = $id';
        $query = mysqli_query($bdd, $req);
        if ($fetch = mysqli_fetch_all($query)) {
            $email = $fetch['email'];
            return "$email";
        }
    }
    public function getFirstname() {
        $bdd = $this->bdd; 
        session_start();
        $id = $_SESSION['id'];
        $req = 'SELECT * FROM utilisateurs WHERE id = $id';
        $query = mysqli_query($bdd, $req);
        if ($fetch = mysqli_fetch_all($query)) {
            $firstname = $fetch['firstname'];
            return "$firstname";
        }
    }
    public function getLastname() {
        $bdd = $this->bdd; 
        session_start();
        $id = $_SESSION['id'];
        $req = 'SELECT * FROM utilisateurs WHERE id = $id';
        $query = mysqli_query($bdd, $req);
        if ($fetch = mysqli_fetch_all($query)) {
            $lastname = $fetch['lastname'];
            return "$lastname";
        }
    }
}
