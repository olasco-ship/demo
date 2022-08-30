<?php 


class idrisdemo implements theSameBlack {

public $name;

public $date;

public $version;

public $manufacturer;



public function __construct($name, $date, $version, $manufacturer, $color) {

$this->name = $name;
$this->date = $date;
$this->version = $version;
$this->manufacturer = $manufacturer;
$this->color = $color;

}


public function theSameBlack(blue) {

echo "theSameBlack";

}


public function try() {

echo "This is". $this->name . " and the date he published is" . $this->date . "and version is" . $this->version . "Manufactured by" . $this->manufacturer . "with color" . $this->color;

} 


}



$idrisdemo = new idrisdemo("Adenola", 12-01-2023, 6.2, "Philip" );

echo $this->name
"<br>"
           ->color;
           


$theSameBlack = new theSameBlack("black");