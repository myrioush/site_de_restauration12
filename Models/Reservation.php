<?php
    /**
     * Created by PhpStorm.
     * User: jyao2
     * Date: 17/06/2019
     * Time: 15:09
     */

    class Reservation
    {
        public $id;
        public $id_cl;
        public $nom_reser;
        public $prenom_reser;
        public $nombre_p;
        public $email;
        public $numero;
        public $date_reser;
        public $heure_reser;

        public static function insert($list){
            $db = Database::connect();
            $statement = $db->prepare('call insertReservation(?,?,?,?,?,?,?,?)');
            $list['num_table'] = self::getNumTable(self::getTable($list['date_reser']));
            $env = array($list['nom_reser'], $list['prenom_reser'], $list['nombre_p'], $list['email'], $list['numero'], $list['date_reser'], $list['heure_reser'], $list['num_table']);
            $statement->execute($env);
            Database::disconnect();
        }

        public static function getTable($date){
            $db = Database::connect();
            $statement = $db->prepare("call getTablesByDay(?)");
            $statement->execute(array($date));
            $list = $statement -> fetchAll();
            $aux = [];
            foreach ($list as $element){
                array_push($aux,$element["num_table"]);
            }
            return $aux;

        }

        public static function getNumTable($list){
            $aux = random_int(1,50);
            while (in_array($aux,$list)){
                $aux = random_int(1,50);
            }
            return $aux;
        }
    }