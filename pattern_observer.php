<?php

class GuardTower implements \SplSubject {

    // common state of the Subject "GuardTower" (for Observers):
    public $state;

    // \SplObjectStorage - simple list of Observers:
    private $observers;


    public function __construct(){

        $this->observers = new \SplObjectStorage();
        $this->state = array('north' => 0, 'west' => 0);
    }


    /**
     * methods for subscribing/unsubscribing
     */
    public function attach(\SplObserver $observer){
        echo "<br><br>Main Tower: Attached an observer ".$observer->name.".";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer){
        $this->observers->detach($observer);
        echo "<br><br>Main Tower: Detached an observer ".$observer->name.".";
    }


    /**
     * notifying Observers
     */
    public function notify(){

        echo "<br>Main Tower: Notifying observers...";

        foreach ($this->observers as $observer){
            $observer->update($this);
        }
    }


    /**
     * some business logic of Subject (before notifying Observers)
     */
    public function setEnemiesNearCoast($direction, $quantity){

        if( $direction == "north" ){
            $this->state[0] = $quantity;
            $toSend = $this->state[0];
        }

        if( $direction == "west" ){
            $this->state[1] = $quantity;
            $toSend = $this->state[1];
        }

        echo "<br><br>Main Tower: I see ".$toSend." enemies in the ".$direction.".";
        $this->notify();
    }
}



/**
 * Concrete Observers
 */

class GuardsAtNorthCoast implements \SplObserver {

    public $name = "Norhern Guards";

    public function update(\SplSubject $subject){

        if( $subject->state[0] > 0 ){

            echo "<br>Northern Guards: Main Tower informs that ".$subject->state[0]." enemies are here! Prepare!";
        }
        else{

            echo "<br>Northern Guards: Main Tower informs that there are not enemies here.";
        }
    }
}


class GuardsAtWesternCoast implements \SplObserver {

    public $name = "Western Guards";

    public function update(\SplSubject $subject){

        if( $subject->state[1] > 0 ){

            echo "<br>Western Guards: Main Tower informs that ".$subject->state[1]." enemies are here! Prepare!";
        }
        else{

            echo "<br>Western Guards: Main Tower informs that there are not enemies here.";
        }
    }
}



// RUN:

$guardTower = new GuardTower();

$observerNorthern = new GuardsAtNorthCoast();
$guardTower->attach($observerNorthern);

$observerWestern = new GuardsAtWesternCoast();
$guardTower->attach($observerWestern);

$guardTower->setEnemiesNearCoast("north", 5);
$guardTower->setEnemiesNearCoast("west", 3);
$guardTower->setEnemiesNearCoast("north", 0);
$guardTower->setEnemiesNearCoast("west", 0);

// from now, there is no observer for the north (even if enemies appear from this direction):
$guardTower->detach($observerNorthern);
$guardTower->setEnemiesNearCoast("north", 12);



/*
EXPECTED OUTPUT:

Main Tower: Attached an observer Norhern Guards.

Main Tower: Attached an observer Western Guards.

Main Tower: I see 5 enemies in the north.
Main Tower: Notifying observers...
Northern Guards: Main Tower informs that 5 enemies are here! Prepare!
Western Guards: Main Tower informs that there are not enemies here.

Main Tower: I see 3 enemies in the west.
Main Tower: Notifying observers...
Northern Guards: Main Tower informs that 5 enemies are here! Prepare!
Western Guards: Main Tower informs that 3 enemies are here! Prepare!

Main Tower: I see 0 enemies in the north.
Main Tower: Notifying observers...
Northern Guards: Main Tower informs that there are not enemies here.
Western Guards: Main Tower informs that 3 enemies are here! Prepare!

Main Tower: I see 0 enemies in the west.
Main Tower: Notifying observers...
Northern Guards: Main Tower informs that there are not enemies here.
Western Guards: Main Tower informs that there are not enemies here.

Main Tower: Detached an observer Norhern Guards.

Main Tower: I see 12 enemies in the north.
Main Tower: Notifying observers...
Western Guards: Main Tower informs that there are not enemies here.
*/
