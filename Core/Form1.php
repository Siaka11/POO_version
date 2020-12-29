<?php

namespace App\Core;


class Form1
{
    private $formCode = '';

    /**
     * Renvoie le formulaire sous forme de fichier html
     *
     * @return void
     */
    public function create()
    {

        return $this->formCode;
    }

    /**
     * Fonction permettant de vérifier la validité d'un formumlaire
     *
     * @param le tableau $form represente soit GET soit POST
     * @param le tableau $champs reprsente l'ensemble des champs dans le tableau
     * @return void
     */
    public static function validate(?array $form, ?array $champs)
    {
        // On parcourt les champs

        foreach ($champs as $champ) {
            // Si le champ est absent ou vide
            if (!isset($form[$champ]) || empty($form[$champ])) {
                return false;
            }
        }
        return true;
    }

    public function ajoutAttributs(?array $attributs): string
    {
        $courts = ['required', 'autofocus', 'disabled', 'checked'];
        foreach ($attributs as $attribut => $valeur) {

            if (in_array($attribut, $courts)) {
                return $this->formCode .= "$attribut";
            } else {
            }
        }
    }

    public function debutForm(string $methode = 'post', string $action = '#', array $attributs = []): self
    {
        $this->formCode .= "<form method = '$methode' action = '$action'";

        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        return $this;
    }

    public function finForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    public function ajoutLabel(string $for, string $texte, ?array $attributs): self
    {
        $this->form .= "<label for = '$for'";
        $this->form .= $attributs ? $this->ajoutAttributs($attributs) : '';
        $this->form .= ">$texte</label>";
        return $this;
    }

    public function ajoutInput(string $type, string $nom, $attributs = []): self
    {
        $this->formCode .= "<input type='$type' name = '$nom";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '/>' : '/>';
        return $this;
    }

    public function ajoutTextarea(string $nom, string $valeur, array $attributs): self
    {
        $this->formCode .= "<textarea name = '$nom'";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';
        $this->formCode .= "> $valeur</textarea>";
        return $this;
    }

    public function ajoutselect(string $id, string $name, ?array $option, $attributs = []): self
    {
        $this->formCode .= "<select id = '$id' name = '$name' ";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        foreach ($option as $valeur => $texte) {
            $this->formCode .= "<option value = '$valeur' > $texte</option>";
        }
        $this->formCode .= "</select>";
        return $this;
    }

    public function ajoutBouton(string $texte, array $attributs = []): self
    {
        $this->formCode .= "<button>";
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
        $this->formCode .= "$texte</button>";

        return $this;
    }
}
