<?php

class User
{

    private string $nom;
    private string $prenom;
    private string $email;
    private int $isDev;

    function insertUserDb($db)
    {

        $insertQuery = $db->prepare("
            INSERT INTO users (nom, prenom, email, isDev)
            VALUES (?,?,?,?)
        ");

        return $insertQuery->execute([$this->nom, $this->prenom, $this->email, $this->isDev]);
    }

    function __construct(string $prenom, string $nom, string $email, int $isDev)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->isDev = $isDev;
    }

    function set_nom($nom)
    {
        $this->nom = $nom;
    }
    function get_nom()
    {
        return $this->nom;
    }

    function set_prenom($prenom)
    {
        $this->prenom = $prenom;
    }
    function get_prenom()
    {
        return $this->prenom;
    }

    function set_email($email)
    {
        $this->email = $email;
    }
    function get_email()
    {
        return $this->email;
    }

    function set_isDev($isDev)
    {
        $this->isDev = $isDev;
    }
    function get_isDev()
    {
        return $this->isDev;
    }
}
