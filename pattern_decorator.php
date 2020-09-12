<?php

/**
 * Basic interface of "SpellCost" component defines behaviour that can be changed by decorators
 */
interface SpellCost {
    
	public function calculateManaToSpend();
}


/**
 * Concrete "SpellCostFireball" and "SpellCostFrostball" components set default behaviour
 */
class SpellCostFireball implements SpellCost {
    
	public function calculateManaToSpend(){
        return 50;
    }
}

class SpellCostFrostball implements SpellCost {
    
	public function calculateManaToSpend(){
        return 30;
    }
}


/**
 * Basic class of Decorator implements the same interface, as other components
 */
class SpellDecorator implements SpellCost {
    
	protected $spellCost;

    public function __construct(SpellCost $spellCost){
        $this->spellCost = $spellCost;
    }

    public function calculateManaToSpend(){
        return $this->spellCost->calculateManaToSpend();
    }
}


/**
 * Concrete Decorators call wrapped object and modify its result
 */
class SpellAdditionalSize extends SpellDecorator {
    
	public function calculateManaToSpend(){
        return 18 . ' + ' . parent::calculateManaToSpend();
    }
}

class SpellAdditionalSpeed extends SpellDecorator {
    
	public function calculateManaToSpend(){
        return 12 . ' + ' . parent::calculateManaToSpend();
    }
}



// RUN:

/**
 * simple components (spells without modifications)
 */

$simpleFireball = new SpellCostFireball();
echo $simpleFireball->calculateManaToSpend();
// 50
echo "<br><br>";

$simpleFrostball = new SpellCostFrostball();
echo $simpleFrostball->calculateManaToSpend();
// 30
echo "<br><br>";


/**
 * decorated components (spells with modifications)
 */

$bigFireball = new SpellAdditionalSize($simpleFireball);
echo $bigFireball->calculateManaToSpend();
// 18 + 50
echo "<br><br>";

$quickFireball = new SpellAdditionalSpeed($simpleFireball);
echo $quickFireball->calculateManaToSpend();
// 12 + 50
echo "<br><br>";

$quickFireball = new SpellAdditionalSpeed($simpleFireball);
$quickAndBigFireball = new SpellAdditionalSize($quickFireball);
echo $quickAndBigFireball->calculateManaToSpend();
// 18 + 12 + 50
echo "<br><br>";

$bigFireball = new SpellAdditionalSize($simpleFireball);
$VERY_bigFireball = new SpellAdditionalSize($bigFireball);
echo $VERY_bigFireball->calculateManaToSpend();
// 18 + 18 + 50
