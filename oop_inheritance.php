<?php

/**
 * Inheritance in PHP
 * 
 * Class "Bird" is parent class, it has:
 * - 2 params: "name", "speed";
 * - 1 method: "fly".
 * 
 * Class "Duck" is subclass of class "Bird", it has:
 * - 1 special param "color";
 * - 1 special method "quack".
 * 
 * Class "Goose" is subclass of class "Bird", it has:
 * - 1 special param "size";
 * - 1 special method "honk".
 * 
 * Class "Penguin" is subclass of class "Bird", it has:
 * - 1 special param "height";
 * - method "fly" which overrides respective parent method.
 * 
*/


class Bird {
    
    public function __construct($name, $speed){
        
        $this->name = $name;
        $this->speed = $speed;
    }
    
    // method for birds:
    public function fly(){
        echo '<br>bird '.$this->name.' flies at a speed of '.$this->speed.' km/h';
    }
}


class Duck extends Bird {
    
    public function __construct($name, $speed, $color){
        
        // as we know, constructor of class "Bird" awaits 2 parameters:
        parent::__construct($name, $speed);
        
        $this->color = $color;
    }
    
    // method for ducks:
    public function quack($quantity){
        
        $result = '';
        for( $i = 0; $i < $quantity; $i++ ){
            $result .= ' quack ';
        }
        echo '<br>'.$this->color.' duck '.$this->name.': "'.trim($result).'"!';
    }
}


class Goose extends Bird {
    
    public function __construct($name, $speed, $size){
        
        // as we know, constructor of class "Bird" awaits 2 parameters:
        parent::__construct($name, $speed);
        
        $this->size = $size;
    }
    
    // method for geese:
    public function honk($quantity){
        
        $result = '';
        for( $i = 0; $i < $quantity; $i++ ){
            $result .= ' honk ';
        }
        echo '<br>'.$this->size.' goose '.$this->name.': "'.trim($result).'"!';
    }
}


class Penguin extends Bird {
    
    public function __construct($name, $speed, $height){
        
        // as we know, constructor of class "Bird" awaits 2 parameters:
        parent::__construct($name, $speed);
        
        $this->height = $height;
    }
    
    // overrided method "fly" for penguins:
    // (Yep, it violates the Liskov substitution principle in SOLID. That's just example.)
    public function fly(){
        
        echo '<br>penguins can not fly, so '.$this->name.' can not fly too!';
    }
}



// DEMO:

/* creating object of parent class - bird */
$bird = new Bird('Sylvester', 180);

$bird->fly();
// >> bird Sylvester flies at a speed of 180 km/h


/* creating object of class-inheritor - duck */
$duck = new Duck('Sam', 50, 'brown');

$duck->fly();
// >> bird Sam flies at a speed of 50 km/h

$duck->quack(3);
// >> brown duck Sam: "quack quack quack"!


/* creating object of class-inheritor - goose */
$goose = new Goose('Jack', 35, 'big');

$goose->fly();
// >> bird Jack flies at a speed of 35 km/h

$goose->honk(2);
// >> big goose Jack: "honk honk"!


/* creating object of class-inheritor - penguin */
$penguin = new Penguin('Yang', 0, 80);

$penguin->fly();
// >> penguins can not fly, so Yang can not fly too!
