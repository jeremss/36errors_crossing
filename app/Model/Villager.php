<?php
namespace Model;

class Villager{
  public function getSummary(){
      $name = $this->name;

      $turnips = $this->turnips."&nbsp;"."<i class='fas fa-lemon'></i>";

      $bells = $this->clochettes."&nbsp;"."<i class='fas fa-bell'></i>";

      return sprintf("%s [%s %s]", $name, $turnips, $bells);
  }
}

