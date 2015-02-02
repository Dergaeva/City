<?php
namespace classes;
header("Content-type: text/html; charset=utf-8");
//mb_internal_encoding("UTF-8");

//include_once 'content.php';
class Apart {
  private $number;
  private $floor;
  private $square;
  private $rooms;
  private $people;
  private $balcons;
  private $balconsSquare;
  private $heatingType;  
    
  private $counters = array ('electr'=>0, 'phone'=>0);   
    
  public function __construct ($ini) {
    $this->number = $ini['number'];  
    $this->floor = $ini['floor'];
    $this->square = $ini['square'];
    $this->rooms = $ini['rooms'];
    $this->people = isset ($ini['people']) ? $ini['people'] : 0;
    $this->balcons = $ini['balcons'];
    $this->balconsSquare = $ini['balconsSquare'];
    $this->heatingType = isset ($ini['heatingType']) ? $ini['heatingType'] : 'центр.';
  }
    
  public function apartInfo() {
    $info = array();   
    $info['number'] =         array ('mes'=>'Номер',           'val'=>$this->number);
    $info['floor'] =          array ('mes'=>'Этаж',            'val'=>$this->floor);
    $info['square'] =         array ('mes'=>'Общая площадь',   'val'=>$this->square);
    $info['rooms'] =          array ('mes'=>'Кол-во комнат',   'val'=>$this->rooms);
    $info['people'] =         array ('mes'=>'Жильцов',         'val'=>$this->people);
    $info['balcons'] =        array ('mes'=>'Кол-во балконов', 'val'=>$this->balcons);
    $info['balconsSquare'] =  array ('mes'=>'Площ. балконов',  'val'=>$this->balconsSquare);
    $info['heatingType'] =    array ('mes'=>'Вид отопл.',      'val'=>$this->heatingType);
    return $info;
  }
  
  public function getPeople() { return $this->people; }
  public function setPeople($value) { $this->people = ($value <= 0 ? 0 : $value); }
  
  public function getCounter($key) { return $this->counters[$key]; }
  public function setCounter($key, $value) { $this->counters[$key] = ($value <= 0 ? 0 : $value); }
    
  public function calcCostRent() {
    return $this->square * Cont::$tariff['rent'];
  }
  public function calcCostWaterCold() {
    return $this->people * Cont::$tariff['waterCold'];
  }
  public function calcCostWaterHot() {
    return $this->people * Cont::$tariff['waterHot'];
  }
  public function calcCostGas() {
    return $this->people * Cont::$tariff['gas'];
  }
  public function calcCostCanalis() {
    return $this->people * Cont::$tariff['canalis'];
  }
  public function calcCostHeat() {
    return ($this->square - $this->balconsSquare) * Cont::$tariff['heat'];
  }
  public function calcCostElectr() {
    return $this->counters['electr'] * Cont::$tariff['electr'];
  }
  public function calcCostPhone() {
    return $this->counters['phone'] * Cont::$tariff['phone'];
  }
  public function calcCostGarbage() {
    return $this->people * Cont::$tariff['garbage'];
  }
    
  public function calcCostSummary() {
    return  $this->calcCostRent()   + $this->calcCostWaterCold() + $this->calcCostWaterHot() +  
            $this->calcCostGas()    + $this->calcCostCanalis()   + $this->calcCostHeat() +
            $this->calcCostElectr() + $this->calcCostPhone()     + $this->calcCostGarbage();
  }
}

 echo 'К В А Р Т И Р А</br>';
  $iniApart = array_merge (array ('number'=>20, 'floor'=>5), Cont::$apartType[$type=2]); 
  $ap = new Apart ($iniApart);
    
  $ap->setPeople(3);
  $ap->setPeople ($ap->getPeople() - 1);
  
  $apInfo = $ap->apartInfo();
  foreach ($apInfo as $key => $value) 
    echo $value['mes'].': '.$value['val'].'</br>';

  $ap->setCounter('electr', 150);
  $ap->setCounter('phone', 40);
  echo 'Квартплата за месяц: '.round ($ap->calcCostSummary(), 2).'</br>';

 ?> 
