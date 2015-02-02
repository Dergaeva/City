<?php
namespace classes;
/*include_once 'content.php';
include_once 'my_flat.php';*/
  
class House {
  private $number;  
  private $floors;
  private $sections;  
  private $apartInCluster;
  private $square; 
     
  private $aparts = array();
    
  public function __construct ($ini) {
    $this->number = $ini['number'];  
    $this->floors = $ini['floors'];
    $this->sections = $ini['sections'];
    $this->square = $ini['square'];       
    $this->apartInCluster = count ($ini['aparts']);
    for ($n=0, $i=0; $i < $this->sections; $i++) 
      for ($j=0; $j < $this->floors; $j++) 
        for ($k=0; $k < $this->apartInCluster; $k++, $n++) {
          $iniApart = array_merge (array ('number'=>$n+1, 'floor'=>$j+1), $ini['aparts'][$k]);
          $this->aparts[$i][$j][$k] = new Apart ($iniApart);
          $this->aparts[$i][$j][$k]->setPeople (rand (1, $ini['aparts'][$k]['rooms'] + 2));
        }
  }

  public function houseInfo() {
    $info = array();   
    $info['number']         = array ('mes'=>'Номер',                  'val'=>$this->number);
    $info['floors']         = array ('mes'=>'Кол-во этажей',          'val'=>$this->floors);
    $info['sections']       = array ('mes'=>'Кол-во подъездов',       'val'=>$this->sections);
    $info['apartInCluster'] = array ('mes'=>'Кол-во квартир на л/к',  'val'=>$this->apartInCluster);
    $info['square']         = array ('mes'=>'Придомовая площадь',     'val'=>$this->square);      
    $info['aparts']         = array ('mes'=>'Квартиры',               'val'=>$this->aparts);
    return $info;    
  }
 
  public function getSections()       { return $this->sections; }
  public function getFloors()         { return $this->floors; } 
  public function getApartInCluster() { return $this->apartInCluster; }
  public function getSquare()         { return $this->square; }
    
  public function getApart ($section, $floor, $cluster){
    return $this->aparts[$section][$floor][$cluster];
  }
  
  public function getApartByNumber ($number) {
    for ($i=0; $i < $this->sections; $i++)
      for ($j=0; $j < $this->floor; $j++)		  
	    for ($k=0; $k < $this->apartInCluster; $k++)
          if ($this->aparts[$i][$j][$k]->number = $number) 
		    return $this->aparts[$i][$j][$k];
  }	
	
  public function calcCostSummaryHouse() {
    for ($sum=0, $i=0; $i < $this->sections; $i++) 
      for ($j=0; $j < $this->floors; $j++) 
        for ($k=0; $k < $this->apartInCluster; $k++) 
          $sum += $this->aparts[$i][$j][$k]->calcCostSummary();
    return $sum;        
  }
    
  public function calcCostLandHouse() {
    return $this->square * Cont::$tariff['landHouse'];
  }
    
  public function calcCostElectrHouse() {
    return $this->sections * $this->floors * Cont::$tariff['electrHouse'];
  } 
}

  echo '</br>Д  О  М</br>'; 
  $iniHouse = array_merge (array ('number'=>7, 'square'=>1200), Cont::$houseType[$type=2]); 
  $iniCluster = array();
  for ($i=0; $i < count (Cont::$clusterType[$type=1]); $i++)
    $iniCluster[$i] = Cont::$apartType[Cont::$clusterType[$type][$i]];
  $iniHouse = array_merge ($iniHouse, array ('aparts'=> $iniCluster)); 
  $hs = new House ($iniHouse);
  
  $hsInfo = $hs->houseInfo();  
  foreach ($hsInfo as $key => $value) {
    if ($key == 'aparts') echo $value['mes'].': '.
      $hsInfo['sections']['val'] * $hsInfo['floors']['val'] * $hsInfo['apartInCluster']['val'].'</br>';
    else echo $value['mes'].': '.$value['val'].'</br>';
  }
   
  for ($i=0; $i < $hsInfo['sections']['val']; $i++) 
    for ($j=0; $j <  $hsInfo['floors']['val']; $j++) 
      for ($k=0; $k < $hsInfo['apartInCluster']['val']; $k++) {
        $apInfo = $hsInfo['aparts']['val'][$i][$j][$k]->apartInfo();		
        $hs->getApart($i,$j,$k)->setCounter('electr', rand(30, 80) * $hs->getApart($i,$j,$k)->getPeople());
        $hs->getApart($i,$j,$k)->setCounter('phone', rand(20, 30) * $hs->getApart($i,$j,$k)->getPeople());
        echo 'Подъезд: '.($i+1).' &nbsp; ';
        foreach ($apInfo as $key => $value) 
          echo $value['mes'].': '.$value['val'].' &nbsp; ';
        echo 'Эл: '.$hs->getApart($i,$j,$k)->getCounter('electr').' &nbsp; ';
        echo 'Тел: '.$hs->getApart($i,$j,$k)->getCounter('phone').' &nbsp; ';
		echo 'Кв/пл: '.round ($hs->getApart($i,$j,$k)->calcCostSummary(), 2);
        echo '</br>';    
      }
 
  echo '> Квартплата за месяц по всему дому: '.round ($hs->calcCostSummaryHouse(), 2).'</br>';
  $sum=0;
  $sum += $hs->calcCostLandHouse ();
  $sum += $hs->calcCostElectrHouse ();
  echo '> Плюс земельный налог и свет на этажах: '.round ($sum, 2).'</br>';

  ?>