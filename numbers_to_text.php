<?php

/**
 * A function for outputting integers as text
 *
 * TODO: Add the ability to use floating point numbers
 * 
 * @param integer $number The number to convert to text
 * @param array $numbers_array The array for text for numbers 0-19, and multiples of 10 up to ninety. Defaults to English
 * @param array $powers The array of strings to use for specific powers of 10. Defaults to American English numbers with a max of quintillion since that's the largest 64 bit integer
 */
function numbers_to_text($number, $numbers_array = null, $powers = null)
{

   if (is_null($numbers_array)) {
      $numbers_array = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
   }

   if (is_null($powers)) {
      $powers = array(2 => 'hundred', 3 => 'thousand', 6 => 'million', 9 => 'billion', 12 => 'trillion', 15=>'quadrillion', 18=>'quintillion');
   }

   $output = false;
   
   if ($number < 21) {
      // Returns the value of the numbers array if less than 21
      $output = $numbers_array[$number];
   } elseif ($number < pow(10, 2)) {
      $output = $numbers_array[10 * floor($number/10)];
		$remainder = $number%10;
		if ($remainder > 0) {
			$output .= '-'. numbers_to_text($remainder);
		}
   } else {
      $power = 2;
      $place = 0;
      foreach ($powers as $pow => $text)
      {
         $place_value = pow(10, intval($pow));
         $tmp_place = $number/$place_value;
         if ($tmp_place < 1)
         {
            break;
         }
         
         $place = $tmp_place;
         $power = $pow;
         $words = $powers[$pow];
      }
      
      if ($power > 0)
      {
         $output = numbers_to_text($place) . ' ' . $words;
         $remainder = $number % pow(10,$power);
         if ($remainder > 0)
         {
            $output .= ' ' . numbers_to_text($remainder);
         }
      }
   }
   
   return $output;
}