<?php

/**
 *
 * Strategy pattern, as shown below, let us select an algorithm at runtime easily.
 *
 */


/**
 *  This interface can be implemented by any type of weapon: sword, axe, staff etc...
 */
interface WeaponBehavior {
    public function useWeapon();
}


class SwordBehaviour implements WeaponBehavior {

    public function useWeapon(){
        echo "<br> sword caused 20 damage!";
    }
}


class AxeBehaviour implements WeaponBehavior {

    public function useWeapon(){
        echo "<br> axe caused 35 damage!";
    }
}


class StaffBehaviour implements WeaponBehavior {

    public function useWeapon(){
        echo "<br> staff caused 5 damage!";
    }
}


class HandBehaviour implements WeaponBehavior {

    public function useWeapon(){
        echo "<br> hand caused no damage!";
    }
}



/**
 *  This class is basic for any type of characters: warriors, mages etc...
 */
class Character{

    private $weaponBehaviour;

    public function __construct($charName, $weaponBehaviour){
        $this->weaponBehaviour = $weaponBehaviour;

        $this->charName = $charName;
    }

    public function setWeapon($weaponBehaviour){
        $this->weaponBehaviour = $weaponBehaviour;
    }

    public function attack(){

        echo "<br><br> " . $this->className . " " . $this->charName . " attacks...";
        $this->weaponBehaviour->useWeapon();
    }
}


class Warrior extends Character {

    // specific properties and functions of warrior...
    public function __construct($charName, $weaponBehaviour){

        parent::__construct($charName, $weaponBehaviour);
        $this->className = "warrior";
    }
}


class Mage extends Character {

    // specific properties and functions of mage...
    public function __construct($charName, $weaponBehaviour){

        parent::__construct($charName, $weaponBehaviour);
        $this->className = "mage";
    }
}



// RUN:

// create a warrior with a sword:
$warrior = new Warrior( "Alex", new SwordBehaviour() );

// warrior attacks by sword:
$warrior->attack();

// warrior found axe and quickly took it instead of sword:
$warrior->setWeapon( new AxeBehaviour() );

// warrior attacks by axe:
$warrior->attack();

// create a mage without any weapon:
$mage = new Mage( "Michael", new HandBehaviour() );

// mage attacks by hand:
$mage->attack();

// mage found staff and quickly took it in hands:
$mage->setWeapon( new StaffBehaviour() );

// mage attacks by staff:
$mage->attack();



/*
EXPECTED OUTPUT:

warrior Alex attacks...
sword caused 20 damage!

warrior Alex attacks...
axe caused 35 damage!

mage Michael attacks...
hand caused no damage!

mage Michael attacks...
staff caused 5 damage!
*/
