<?php

namespace Controller;

use \Library\Request;
use \Model\Factory\Village as VillageFactory;
use \Model\Factory\Villager as VillagerFactory;
use \Model\Factory\Farm as FarmFactory;
use \Model\Factory\Market as MarketFactory;

class Turn extends General{

  public function nextAction(Request $request){

    //get all cities
    $villageFactory = new VillageFactory($this->pdo);
    $villages = $villageFactory->get_all();

    //get all villagers
    $villagerFactory = new VillagerFactory($this->pdo);
    $villagers = $villageFactory->get_all();

    //déplace les villageois
    foreach($villagers as $villager){
      $pickRandomCity = random_int(0, count($villages));
      
      $villagerFactory->moveVillagerTo($villages[$pickRandomCity]->id, $villager);
    }
    //refresh
    $villagers = $villagerFactory->get_all();


    //get all farms
    // grow turnips in farm
    $farmFactory = new FarmFactory($this->pdo);
    $farms = $farmFactory->get_all();
    foreach ($farms as $farm) {
      $farmFactory->grow($farm);
    }
    //refresh
    $farms = $farmFactory->get_all();

    // distribute turnips
    foreach($farms as $farm){
      $farmStock = $farm->stock;
      foreach ($villagers as $villager) {
        if($farmStock > 0 && $villager->village_id == $farm->village_id){
          $villagerFactory->acquireTurnip($villager);
        }else{
          break;
        }
      }
      $farmStock--;
      $farmFactory->saveStock($farm, $farmStock);
    }

    //get all markets
    $marketFactory = new MarketFactory($this->pdo);
    $markets = $marketFactory->get_all();

    foreach($markets as $market){
      foreach ($villagers as $villager) {
        if($villager->turnips > 0 && $villager->village_id == $market->village_id){
          $villagerFactory->exchangeTurnips($villagers);
        }
      }
    }

    header("Location: /");
    exit;
    
  }

}