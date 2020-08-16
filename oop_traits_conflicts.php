/**
 * Resolving traits conflicts in PHP
 * 
 * This example is based on code taken from:
 * https://github.com/igorsimdyanov/php7/blob/master/inherit/traits_conflict.php
 * 
*/


trait Header {
    
    public function getBackground(){
        echo "Header::getBackground<br>";
    }
    
    public function getBorder(){
        echo "Header::getBorder<br>";
    }
}


trait Footer {
    
    public function getBackground(){
        echo "Footer::getBackground<br>";
    }
    
    public function getBorder(){
        echo "Footer::getBorder<br>";
    }
}


class Landing {
    
    use Footer, Header {
        Header::getBackground insteadof Footer;
        Footer::getBorder insteadof Header;
        Footer::getBackground as footerBackground;
    }
}


$landing = new Landing();

$landing->getBackground();
// >> Header::getBackground

$landing->getBorder();
// >> Footer::getBorder

$landing->footerBackground();
// >> Footer::getBackground
