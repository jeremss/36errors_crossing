<?php 
namespace Model\Factory;

class Villager extends AbstractFactory{

  public function get_all(){
    $q = "SELECT villager.*, 
                villager_position.village_id FROM villager
          JOIN villager_position ON villager.id = villager_position.villager_id
        ;";
    $stmt = $this->pdo->query($q);
    $recettes = $stmt->fetchAll(\PDO::FETCH_CLASS, "\\Model\\Villager");


    return $recettes;
  }

  public function add_one($name){

    $q = "INSERT INTO villager SET name = :name";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":name" => $name]);
    $id = $this->pdo->lastInsertId();

    return $id;

  }

  public function get_one($id){
    $q = "SELECT * FROM villager WHERE id = :id";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":id" => $id]);
    $recette = $stmt->fetchObject("\\Model\\Villager");
    return $recette;
  }

  public function moveVillagerTo($villager, $village_id){
    $q = "INSERT INTO villager_position SET villager_id = :villager_id, village_id = :village_id ON DUPLICATE KEY UPDATE village_id = VALUES(village_id)";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":villager_id" => $villager->id,
                    ":village_id" => $village_id,
                   ]);
    $id = $this->pdo->lastInsertId();

    return $id;
  }

  public function acquireTurnip($villager){
    $q = "UPDATE villager SET turnips = turnips+1 WHERE id = :villager_id";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":villager_id" => $villager->id]);

    //update in model !
    $villager->turnips += 1;
    return 1;
  }

  public function exchangeTurnips($villager){
    $q = "UPDATE villager 
            SET clochettes = clochettes + turnips, 
                turnips = 0 
          WHERE id = :villager_id";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":villager_id" => $villager->id]);

    //update in model !
    $villager->clochettes = $villager->clochettes + $villager->turnips;
    $villager->turnips = 0;

    return 1;
  }
}