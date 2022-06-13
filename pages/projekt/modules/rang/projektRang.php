<?php

class projektRang
{
    public $permission;
    public $rangid;

    public $name;
    public $desc;

    public $color;
    public $bgColor;

    private $noperm = true;

    function __construct1() {

    }
    function __construct($rangid, $pdo) {
       if($rangid == -1){
           $this->permission = array();
           $this->rangid = -1;
           $this->noperm = true;
           return;
       }


        $this->permission = array();
        $this->rangid = $rangid;

       // $this->checkRang($pdo);

        $this->loadPermission($pdo);
    }


    function loadPermission($pdo){
        if($this->rangid == -1) return;

        if (!empty($pdo)) {
            $sth = $pdo->prepare("SELECT * FROM projekt_rang_permission_syc WHERE Rang = ? AND Haspermission = true");
            $sth->bindParam(1, $this->rangid);
            $sth->execute();

            foreach($sth->fetchAll() as $row) {
                $id = $row['Permission'];

                $sth1 = $pdo->prepare("SELECT * FROM projekt_rang_permission WHERE ID = ? LIMIT 1 ");
                $sth1->bindParam(1, $id);
                $sth1->execute();

                foreach($sth1->fetchAll() as $row1) {
                    array_push($this->permission, $row1['Permission']);

                    if($this->noperm){
                        $this->noperm = false;
                    }
                }
            }
        }

        return $this->permission;
    }

    function hasPermission($permissionString){
        if($this->noperm){
            return false;
        }

        if(in_array($permissionString, $this->permission)){
            return true;
        }else {
            return false;
        }
    }
}