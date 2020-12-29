<?php

namespace App\Models;

use PDO;
use App\Core\Db;

class Model extends Db
{

    protected $table;

    //Instance de db

    private $db;



    public function findBy($criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = " $champ = ? ";
            $valeurs[] = $valeur;
        }
        var_dump($champs);
        $liste_champs = implode(' AND ', $champs);
        var_dump($liste_champs);

        $query = $this->requete("SELECT * FROM $this->table WHERE $liste_champs", $valeurs);
        return $query->fetchAll();
    }

    public function createOne()
    {


        $champs = [];
        $inter = [];
        $valeurs = [];


        foreach ($this as $champ => $valeur) {



            if ($valeur !== null && $champ != "db" && $champ != "table") {

                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(',', $champs);
        $liste_inter = implode(',', $inter);


        return $this->requete('INSERT INTO ' . $this->table . '(' . $liste_champs . ') VALUES(' . $liste_inter . ')', $valeurs);
    }

    public function update()
    {

        $champs = [];
        $valeurs = [];


        foreach ($this as $champ => $valeur) {

            if ($valeur !== null && $champ != "db" && $champ != "table") {

                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $this->id;
        $liste_champs = implode(',', $champs);

        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }

    public function findAll()
    {
        //  $this->db = Db::getInstance();
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }


    public function find(int $id)
    {
        return $this->requete("SELECT * FROM  $this->table WHERE id = $id ")->fetch();
    }

    public function delete(int $id)
    {

        return $this->requete('DELETE FROM ' . $this->table . ' WHERE id = ' . $id);
    }



    public function requete(string $sql, ?array $attributs = null)
    {
        $this->db = Db::getInstance();


        if ($attributs !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //requête simple 
            return $this->db->query($sql);
        }
    }

    public function hydrate($donnees)
    {


        foreach ($donnees as $key => $value) {
            $setter = 'set' . ucfirst($key);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}
