<?php
namespace classes;
//include_once 'content.php';
//include_once 'my_flat.php';
//include_once 'my_house.php';

class Street {
  private $name;  
  private $length;
  private $houseOnStreet;
  private $coords = array (
    'start' => array ('x' => 0, 'y' => 0),
    'finish' => array ('x' => 0, 'y' => 0),
  ); 
   
  private $houses = array();
 
  public function __construct ($ini) {
    $this->name = $ini['name'];  
    $this->length = $ini['length'];
    $this->coords = $ini['coords'];          
    $this->houseOnStreet = count ($ini['houseType']); 
    
    for ($n=0; $n < $this->houseOnStreet; $n++) {
      $iniHouse = array ('number'=> $n+1, 'square'=> $ini['square'][$n]);
      $type = $ini['houseType'][$n];  
      $iniHouse = array_merge ($iniHouse, Cont::$houseType[$type]);
      
      $iniCluster = array();
      $type = $ini['clusterType'][$n];      
      for ($i=0; $i < count (Cont::$clusterType[$type]); $i++)
        $iniCluster[$i] = Cont::$apartType[Cont::$clusterType[$type][$i]]; 
      
      $iniHouse = array_merge ($iniHouse, array ('aparts'=> $iniCluster)); 
      $this->houses[$n] = new House ($iniHouse);
    }
  }
   
  public function streetInfo() {
    $info = array();   
    $info['name']        = array ('mes'=>'Название',        'val'=>$this->name);
    $info['length']      = array ('mes'=>'Протяженность',   'val'=>$this->length);
    $info['stXcoord']    = array ('mes'=>'Начало улицы X',  'val'=>$this->coords['start']['x']);      
    $info['stYcoord']    = array ('mes'=>'Начало улицы Y',  'val'=>$this->coords['start']['y']);
    $info['finXcoord']   = array ('mes'=>'Конец улицы X',   'val'=>$this->coords['finish']['x']);
    $info['finYcoord']   = array ('mes'=>'Конец улицы Y',   'val'=>$this->coords['finish']['y']);
    $info['houses']      = array ('mes'=>'Дома',            'val'=>$this->houseOnStreet);
    return $info;    
  }
  
  public function getHouseOnStreet() { return $this->houseOnStreet; }  
  public function getHouse ($number) { return $this->houses[$number]; }
  
 public function calcNumberCleaner() {
    for ($sum=0, $n=0; $n < $this->houseOnStreet; $n++)    
      $sum += $this->houses[$n]->getSquare();
    return ceil ($sum / Cont::$tariff['cleanerStreet']);
  }
  
  public function calcCostSummaryStreet() {
    for ($sum=0, $n=0; $n < $this->houseOnStreet; $n++)    
      $sum += $this->houses[$n]->calcCostSummaryHouse();
    return $sum;
  }
}

echo '</br>У Л И Ц А</br>'; 
  $iniStreet = Cont::$streetType[$type=0];      
  $st = new Street ($iniStreet);
  $stInfo = $st->streetInfo();  
  foreach ($stInfo as $key => $value) {
    if ($key == 'houses') echo $value['mes'].': '.$houseOnStreet = $value['val'].'</br>';
    else echo $value['mes'].': '.$value['val'].'</br>';
  }
  
  $sum=0;
  for ($i=0; $i < $houseOnStreet; $i++) {
    $hsInfo = $st->getHouse($i)->houseInfo(); 
    foreach ($hsInfo as $key => $value) {
      if ($key == 'aparts') echo $value['mes'].': '.
        $hsInfo['sections']['val'] * $hsInfo['floors']['val'] *
		  $hsInfo['apartInCluster']['val'].' &nbsp; ';
      else echo $value['mes'].': '.$value['val'].' &nbsp; ';  
    }
    echo 'Кв/пл. по дому: '.round ($st->getHouse($i)->calcCostSummaryHouse(), 2).'</br>'; 
	$sum += $st->getHouse($i)->calcCostLandHouse ();
	$sum += $st->getHouse($i)->calcCostElectrHouse ();
  }
  echo '> Квартплата за месяц по улице: '.round ($st->calcCostSummaryStreet(), 2).'</br>';
  echo '> Плюс земельный налог и свет на этажах: '.round ($sum, 2).'</br>';
  echo '> Дворников на улицу (один на 500м2): '.$st->calcNumberCleaner().'</br>';

  ?>

 

 