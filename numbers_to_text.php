<?php

function numbers_to_text($number, $numbers_array = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'), $powers = array(2 => 'hundred', 3 => 'thousand', 6 => 'million', 9 => 'billion', 12 => 'trillion', 15=>'quadrillion', 18=>'quintillion'))
{
   $output = '';
   
   if ($number < 21) { // Returns the output array if it's less than 21
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

$test_array = array(1=>'one', 2=>'two', 11=>'eleven', 20=>'twenty', 21=>'twenty-one', 22=>'twenty-two', 42=>'forty-two', 142=>'one hundred forty-two', 1001=>'one thousand one', 1234=>'one thousand two hundred thirty-four', 1337=>'one thousand three hundred thirty-seven', 9999=>'nine thousand nine hundred ninety-nine', 10000=> 'ten thousand', 1000000=>'one million', 123456789=>'one hundred twenty-three million four hundred fifty-six thousand seven hundred eighty-nine');

$test_array[round(pi() * pow(10, 18))] = 'three quintillion one hundred forty-one quadrillion five hundred ninety-two trillion six hundred fifty-three billion five hundred eighty-nine million seven hundred ninety-three thousand two hundred eighty';

$test_array[2147483647] = 'two billion one hundred forty-seven million four hundred eighty-three thousand six hundred forty-seven'; // Maximum 32 bit integer value
$test_array[9223372036854775807] = 'nine quintillion two hundred twenty-three quadrillion three hundred seventy-two trillion thirty-six billion eight hundred fifty-four million seven hundred seventy-five thousand eight hundred seven'; // Maximum 64 bit integer value

foreach ($test_array as $input_value => $test_value)
{
   $output_value = numbers_to_text($input_value);
   echo $input_value . ': ' . $output_value;
   if ($test_value != $output_value)
   {
      echo ' FAILURE';
   }
   echo "\n";
}