<?php
    /**
     * Created by PhpStorm.
     * User: jyao2
     * Date: 17/06/2019
     * Time: 14:38
     */

    class Client
    {
        public $id_cl;
        public $nom_cl;
        public $prenom_cl;
        public $num_cl;
        public $email_cl;
        public $mdp_cl;

        public function __construct($nom, $mdp){
            $db = Database::connect();
            $statement = $db->prepare("call getClientByName_Password(?,?)");
            $statement->execute(array($nom, $mdp));
            $var = $statement->fetch();
            $this->id_cl = $var['id_cl'];
            $this->nom_cl = $var['nom_cl'];
            $this->prenom_cl = $var['prenom_cl'];
            $this->num_cl = $var['num_cl'];
            $this->email_cl = $var['email_cl'];
            $this->mdp_cl = $var['mdp_cl'];
            Database::disconnect();
        }


    }