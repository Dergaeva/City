<?php
namespace classes;

class Cont {
  public static $tariff = array (
    'rent'=>3.5, 
    'waterCold'=>5.17, 
    'waterHot'=>23.15, 
    'gas'=>12.73, 
    'canalis'=>3.03,
    'heat'=>0.36,
    'electr'=>9.58,
    'phone'=>0.15,
    'garbage'=>9.5,
    'landHouse'=>3.0,
    'electrHouse'=>1.34,
	'cleanerStreet'=>50,
	
	/*'volum'=>4.00, 
    'taxLang'=>3.66, 
	'electrHouse'=>1.34,*/
  );
        
  public static $apartType = array (
    1 => array ('rooms'=>1, 'square'=>33.5, 'balcons'=>1, 'balconsSquare'=>3.3),
    2 => array ('rooms'=>2, 'square'=>46.2, 'balcons'=>1, 'balconsSquare'=>3.3, 'heatingType'=>'автономное'),
    3 => array ('rooms'=>3, 'square'=>63.0, 'balcons'=>2, 'balconsSquare'=>6.4),
    4 => array ('rooms'=>4, 'square'=>82.0, 'balcons'=>3, 'balconsSquare'=>9.2),    
  );
     
   public static $clusterType = array (
    1 => array (1, 3, 2, 3),
    2 => array (1, 3, 1, 4),
    3 => array (1, 3, 1, 2, 2),
  );
  
  public static $houseType = array (
    1 => array ('sections'=>2, 'floors'=>6),
    2 => array ('sections'=>3, 'floors'=>6),                       
    3 => array ('sections'=>2, 'floors'=>9),
    4 => array ('sections'=>3, 'floors'=>9),
    5 => array ('sections'=>6, 'floors'=>9),
  );
    
  public static $streetType = array (
    0 => array ('name'=>'ул. С.Грицевца', 'length'=>3.2, 
	      'coords'=> array ('start'=> array ('x'=>940.326, 'y'=>520.523), 
                            'finish'=> array ('x'=>124.458, 'y'=>728.673)),
          'houseType'   => array (  3,   1,   2,   2,    4,   3,   2,    5),
          'clusterType' => array (  1,   1,   1,   3,    3,   2,   2,    1),
          'square'      => array (600, 650, 540, 720, 1200, 950, 870, 1130),
    ),
    
    1 => array ('name'=>'ул. Сумска', 'length'=>2.2, 
	      'coords'=> array ('start'=> array ('x'=>342.155, 'y'=>434.586), 
		                    'finish'=> array ('x'=>213.156, 'y'=>563.622)),
          'houseType'   => array (  1,   5,   5,   5,    4,   4,   3,    5,   3,   3,   3),
          'clusterType' => array (  2,   2,   1,   1,    3,   2,   2,    1,   2,   2,   2),
          'square'      => array (610, 540, 660, 450, 1020, 780, 770, 1020, 550, 560, 550),
    ),
    
    2 => array ('name'=>'ул. Бекетова', 'length'=>1.5,
	      'coords'=> array ('start'=> array ('x'=>100.712, 'y'=>904.786), 
		                    'finish'=> array ('x'=>201.506, 'y'=>216.612)),
          'houseType'   => array (  3,   3,   1,   2,   4),
          'clusterType' => array (  1,   2,   1,   1,   3),
          'square'      => array (510, 770, 680, 450, 820),
    ), 
  );  
}

 ?> 