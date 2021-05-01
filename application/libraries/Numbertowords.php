<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Numbertowords extends MX_Controller{
      
      function convert_number($number) {
            $num=$number;
            if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
            }
            $Gn = floor($number / 1000000);
             
            $number -= $Gn * 1000000;
            $kn = floor($number / 1000);
            
            $number -= $kn * 1000;
            $Hn = floor($number / 100);
           
            $number -= $Hn * 100;
            $Dn = floor($number / 10);
           
            $n = $number % 10;
            
            $res = "";
            if ($Gn) {
                  $res .= $this->convert_number($Gn) . " Million";
            }
            if ($kn) {
                  $res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
            }
            if ($Hn) {
                  $res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
            }
            $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
            $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
            
            if ($Dn || $n) {
                  if (!empty($res)) {
                        $res .= " and ";
                  }
                  if ($Dn < 2) {
                        $res .= $ones[$Dn * 10 + $n];
                  } else {
                        $res .= $tens[$Dn];
                        if ($n) {
                        $res .= "-" . $ones[$n];
                        }
                  }
            }
            if (empty($res)) {
                  $res = "zero";
            }

            $points = substr(number_format($num,2),-2,2);
            if($points > 0){
                  $Dn = floor($points / 10);
                  
                  $n = $points % 10;
                            
                        if ($Dn || $n) {
                              if (!empty($res)) {
                                    $res .= " point ";
                              }
                              if ($Dn < 2) {
                                    $res .= $ones[$Dn * 10 + $n];
                              } else {
                                    $res .= $tens[$Dn];
                                    if ($n) {
                                          $res .= "-" . $ones[$n];
                                    }
                              }
                               $res .= "";
                        }
                  
            }
            
            return $res;
      }

}
?>