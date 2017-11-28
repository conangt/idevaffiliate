<?PHP

// Basic function for outputting errors to screen.  Designed to
// be very basic in case you want to add your own functionality.
// --------------------------------------------------------------

 define('DEBUG_LEVEL', '0');

 switch(DEBUG_LEVEL) {
 case 0: error_reporting (0); break;
 case 1: error_reporting(E_ERROR | E_WARNING | E_PARSE); break;
 case 2: error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); break;
 case 3: error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); break;
 case 4: error_reporting(E_ALL ^ E_NOTICE); break;
 case 5: error_reporting(E_ALL); break;
 
 default:
 error_reporting(E_ALL);
   
}

?>