<?php
namespace App\controllers;

use App\config\Database;
class CombatController extends Controller {
    public function index($idCombattant1, $idCombattant2)
    {
        $db = new Database();

        // ajout d'un combat en DB
        $sql = "INSERT INTO combat(id_combattant_1, id_combattant_2) VALUES(:idCombattant1, :idCombattant2);";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute([':idCombattant1' => $idCombattant1, ':idCombattant2' => $idCombattant2]);

        // Récupérer l'id du combat
        $sql = "SELECT Id FROM combat ORDER BY Id DESC LIMIT 1";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();
        $idCombat = $stmt->fetch();

        // combattant 1
        $combattant1 = [];
        $sql = "SELECT combattant.Id, combattant.nom, combattant.force, combattant.sante, combattant.niveau, style.nom AS 'style' FROM combattant INNER JOIN style ON style.Id = combattant.id_style WHERE combattant.Id = :idCombattant1";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idCombattant1' => $idCombattant1]);
        $combattant1[] = $stmt->fetch(\PDO::FETCH_ASSOC);

        // aptitude
        $sql = "SELECT aptitude.Id, aptitude.nom, combattant_aptitude.note FROM combattant INNER JOIN combattant_aptitude ON combattant_aptitude.id_combattant = combattant.Id INNER JOIN aptitude ON aptitude.Id = combattant_aptitude.id_aptitude WHERE combattant.Id = :idCombattant1";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idCombattant1' => $idCombattant1]);
        $combattant1[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        // combattant 2
        $combattant2 = [];
        $sql = "SELECT combattant.Id, combattant.nom, combattant.force, combattant.sante, combattant.niveau, style.nom AS 'style' FROM combattant INNER JOIN style ON style.Id = combattant.id_style WHERE combattant.Id = :idCombattant2";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idCombattant2' => $idCombattant2]);
        $combattant2[] = $stmt->fetch(\PDO::FETCH_ASSOC);

        // aptitude
        $sql = "SELECT aptitude.Id, aptitude.nom, combattant_aptitude.note FROM combattant INNER JOIN combattant_aptitude ON combattant_aptitude.id_combattant = combattant.Id INNER JOIN aptitude ON aptitude.Id = combattant_aptitude.id_aptitude WHERE combattant.Id = :idCombattant2";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idCombattant2' => $idCombattant2]);
        $combattant2[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->renderPhpView('combat.php', ['idCombat' => $idCombat, 'combattant1' => $combattant1, 'combattant2' => $combattant2]);
    }

    public function round()
    {
        $db = new Database();

        $data = json_decode(file_get_contents('php://input'));

        // ajout le coup en DB
        $sql = "INSERT INTO round(id_combat, id_aptitude, id_combattant) VALUES(:id_combat, :id_aptitude, :id_combattant);)";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['id_combat' => $data->id_combat, 'id_aptitude' => $data->id_aptitude, 'id_combattant' => $data->id_combattant]);

        return json_encode(['success' => true]);
    }

    public function winner() {
        $db = new Database();
        $data = json_decode(file_get_contents('php://input'));

        $sql = "UPDATE combat SET gagnant = :idWinner WHERE combat.Id = :idCombat;";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idWinner' => $data->winner, 'idCombat' => $data->id_combat]);

        // Récupérer le nom du gagnant
        $sql = "SELECT nom FROM combattant WHERE Id = :idWinner";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idWinner' => $data->winner]);
        $winnerName = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Récupérer le nom du perdant
        $sql = "SELECT nom FROM combattant WHERE Id = :idLoser";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['idLoser' => $data->loser]);
        $loserName = $stmt->fetch(\PDO::FETCH_ASSOC);

        return json_encode(['success' => true, 'winner' => $winnerName['nom'], 'loser' => $loserName['nom']]);
    }
}