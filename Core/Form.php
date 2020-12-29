<?php

namespace App\Core;

class Form
{
    private $formCode = '';

    /**
     * @return String
     */
    public function create(): string
    {
        return $this->formCode;
    }

    public static function validate(?array $method, ?array $champs)
    {

        foreach ($champs as $champ) {
            //var_dump($champ);
            if (!isset($method[$champ]) || empty($method[$champ])) {

                return false;
            }
        }
        return true;
    }

    public function ajoutAttribut(array $attributs): string
    {
        //on initialise une chaîne de caractère
        $str = '';

        $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        foreach ($attributs as $attribut => $valeur) {

            if (in_array($attribut, $courts) && $valeur == true) {
                $str .= " $attribut";
            } else {
                $str .= " $attribut =\"$valeur\"";
            }
        }

        return $str;
    }

    public function debutForm(string $methode = 'post', string $action = '#', array $attributs = []): self
    {
        $this->formCode .= "<form method = '$methode' action = '$action' ";

        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';
        return $this;
    }

    public function finForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    public function ajoutLabelFor(string $for, string $texte, ?array $attributs = []): self
    {
        $this->formCode .= "<label for='$for'";

        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';
        $this->formCode .= ">$texte</label>";
        return $this;
    }

    public function ajoutInput(string $type, string $nom, ?array $attributs = []): self
    {
        $this->formCode .= "<input type = '$type' name ='$nom'";

        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        return $this;
    }

    public function ajoutTextarea(string $nom, string $valeur, ?array $attributs = []): self
    {
        $this->formCode .= "<textarea name = '$nom' ";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }

    public function ajoutSelect(string $nom, ?array $options, ?array $attributs = []): self
    {
        //on crée le selcet 

        $this->formCode .= "<select name='$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) . '>' : '>';

        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value = \"$valeur\">$texte</option>";
        }

        $this->formCode .= '</select>';

        return $this;
    }

    public function ajoutBouton(string $texte, ?array $attributs): self
    {
        $this->formCode .= '<button ';

        $this->formCode .= $attributs ? $this->ajoutAttribut($attributs) : '';
        $this->formCode .= ">$texte</button>";
        return $this;
    }
}
