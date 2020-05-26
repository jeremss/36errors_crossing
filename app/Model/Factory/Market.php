<?php 
namespace Model\Factory;

class Market extends AbstractFactory{

  public function get_all(){
    $q = "SELECT  FROM market;";
    $stmt = $this->pdo->query($q);
    $markets = $stmt->fetchAll(\PDO::FETCH_CLASS, "\\Model\\Village");

    return $markets;
  }


  public function countInVillage($village_id){
    $q = "SELECT COUNT(1) as c FROM market WHERE village_id = :village_id";

    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":village_id" => $village_id]);
    $count = $stmt->fetchColumn();
    
    return $count;
  }

}