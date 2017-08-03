<?php

require_once('numbers_to_text.php');

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