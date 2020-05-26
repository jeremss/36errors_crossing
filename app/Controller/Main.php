<?php

namespace Controller;

use \Library\Request;
use \Model\Factory\Village as VillageFactory;
use \Model\Factory\Villager as VillagerFactory;
use \Model\Factory\Farm as FarmFactory;
use \Model\Factory\Market as MarketFactory;

class Main extends General{

  function indexAction(Request $request){

    $villageFactory = new VillageFactory($this->pdo);
    $villages = $villageFactory->get_all();


    $villagerFactory = new VillagerFactory($this->pdo);
    $villagers = $villagerFactory->get_all();

    $villagerFactory = new VillagerFactory($this->pdo);
    $villagers = $villagerFactory->get_all();


    foreach ($villages as $village) {
      foreach ($villagers as $villager) {
        if($villager->village_id == $village->id){
          $village->addVillager($villager);
        }
      }
    }
    
    include("views/home.html.php");

  }
}