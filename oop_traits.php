<?php

/**
 * Traits in PHP
 * 
 * Class "Duck" has:
 * - 1 special param "color";
 * - 1 special method "quack".
 * 
 * Class "Goose" has:
 * - 1 special param "size";
 * - 1 special method "honk".
 * 
 * Trait "Voice" can be used by both classes "Duck" and "Goose"
 * 
*/


trait Voice {
    
    public function voice($word, $quantity){
        
        $result = '';
        for( $i = 0; $i < $quantity; $i++ ){
            $result .= ' '.$word.' ';
        }
        
        return trim($result);
    }
}


class Duck {
    
    use Voice;
    
    public function __construct($color){
        
        $this->color = $color;
    }
    
    // method for ducks:
    public function quack($quantity){
        
        echo '<br>'.$this->color.' duck: "'.$this->voice('quack', $quantity).'"!';
    }
}


class Goose {
    
    use Voice;
    
    public function __construct($size){
        
        $this->size = $size;
    }
    
    // method for geese:
    public function honk($quantity){
        
        echo '<br>'.$this->size.' goose: "'.$this->voice('honk', $quantity).'"!';
    }
}


$duck = new Duck('brown');
$duck->quack(3);
// >> brown duck: "quack quack quack"!


$goose = new Goose('big');
$goose->honk(2);
// >> big goose: "honk honk"!
