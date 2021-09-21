<?php

class StringsGenerator
{
	public function __construct()
	{
		$this->digits = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
		$this->bigLettersLatin = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		$this->smallLettersLatin = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		$this->bigLettersLatinExplicit = ['D', 'F', 'G', 'J', 'L', 'N', 'Q', 'R', 'S', 'U', 'V', 'W', 'Z'];
	}
	
	
	public function generateRandomString($charGroup, $length)
    {
		$charGroupDetected = false;
		
		if ($charGroup == 'all_letters_and_digits') {
			$array = array_merge($this->smallLettersLatin, $this->bigLettersLatin, $this->digits);
			$charGroupDetected = true;
		}
		
		if ($charGroup == 'small_letters_and_digits') {
			$array = array_merge($this->smallLettersLatin, $this->digits);
			$charGroupDetected = true;
		}
		
		if ($charGroup == 'all_letters') {
			$array = array_merge($this->smallLettersLatin, $this->bigLettersLatin);
			$charGroupDetected = true;
		}
		
		if ($charGroup == 'explicit_latin_letters') {
			$array = array_merge($this->bigLettersLatinExplicit);
			$charGroupDetected = true;
		}
		
		if (!$charGroupDetected) {
			exit('StringsGenerator: charGroup is not detected');
		}
		
		$result = '';
		
		for ($i = 0; $i < $length; $i++) {
            $result .= $array[array_rand($array)];
        }
		
		return $result;
	}
}


/*
$sg = new StringsGenerator();

$cg = 'all_letters_and_digits';
echo '<br><br>' . $cg . ':<br>' . $sg->generateRandomString($cg, 32);

$cg = 'small_letters_and_digits';
echo '<br><br>' . $cg . ':<br>' . $sg->generateRandomString($cg, 32);

$cg = 'all_letters';
echo '<br><br>' . $cg . ':<br>' . $sg->generateRandomString($cg, 32);

$cg = 'explicit_latin_letters';
echo '<br><br>' . $cg . ':<br>' . $sg->generateRandomString($cg, 5);
*/
