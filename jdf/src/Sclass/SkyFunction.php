<?php

/**
 * @file
 * Contains \Drupal\jdf\Plugin\views\field\PHPViewsField.
 */

namespace Drupal\jdf\Sclass;

class SkyFunction {

 public function barcode_check($digits) {
   $even_sum = 0;
   $odd_sum = 0;
   if (strlen($digits) == 8 || strlen($digits) == 13) {
     $check = substr($digits, -1);
     $digits = strrev(substr($digits, 0, -1));
     for ($i = 0; $j = strlen($digits), $i < $j; $i++) {
       if (is_numeric($digits[$i])) ( $i & 1 ) ? $even_sum = $even_sum + $digits[$i] : $odd_sum = $odd_sum + $digits[$i];
       else return FALSE;
     }
     $total_sum = $even_sum + $odd_sum * 3;
     $next_ten = (ceil($total_sum/10))*10;
     $check_digit = $next_ten - $total_sum;
     if ($check == $check_digit) return TRUE;
   }
   return FALSE;
 }
 }