<?php

namespace App\controllers;

use App\config\Database;

class CombattantController extends Controller
{
    public function getAllCombattant() {
        $db = new Database();

        $sql = "SELECT combattant.Id, combattant.nom, combattant.force, combattant.sante, combattant.niveau, style.nom AS 'style' FROM combattant INNER JOIN style ON style.Id = combattant.id_style";

        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();

        $allCombattants = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->renderPhpView('combattant.php', ['combattants' => $allCombattants]);
    }

    public function getCombattantById($id) {
        $db = new Database();

        $sql = "SELECT combattant.nom, combattant.force, combattant.sante, combattant.niveau, style.nom AS 'style' FROM combattant INNER JOIN style ON style.Id = combattant.id_style WHERE combattant.Id = :id";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $combattant = $stmt->fetch(\PDO::FETCH_ASSOC);

        // aptitude
        $sql = "SELECT aptitude.nom, combattant_aptitude.note FROM combattant INNER JOIN combattant_aptitude ON combattant_aptitude.id_combattant = combattant.Id INNER JOIN aptitude ON aptitude.Id = combattant_aptitude.id_aptitude WHERE combattant.Id = :id";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $aptitudes = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        if (!$combattant) {
            return $this->renderPhpView('404.php', ['message' => "Combattant introuvable"]);
        }

        return $this->renderPhpView('combattant-detail.php', ['combattant' => $combattant, 'aptitudes' => $aptitudes]);
    }
}
