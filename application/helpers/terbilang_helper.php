<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('number_to_words'))
{
    function number_to_words($number)
    {
        $before_comma = trim(to_word($number));
        $after_comma = trim(comma($number));
        return ucwords($results = $before_comma.' point '.$after_comma);
    }

    function to_word($number)
    {
        $words = "";
        $arr_number = array(
        "",
        "One",
        "Two",
        "Three",
        "Four",
        "Five",
        "Six",
        "Seven",
        "Eight",
        "Nine",
        "Ten",
        "Eleven",
        "Twelve",
        "Thirteen",
        "Fourteen",
        "Fifteen",
        "Sixteen",
        "Seventeen",
        "Eighteen",
        "Nineteen",

        );

        if($number<20)
        {
            $words = " ".$arr_number[$number];
        }
        else if($number<20)
        {
            $words = to_word($number-10)." belas";
        }
        else if($number<100)
        {
            $words = to_word($number/10)." puluh ".to_word($number%10);
        }
        else if($number<200)
        {
            $words = "seratus ".to_word($number-100);
        }
        else if($number<1000)
        {
            $words = to_word($number/100)." Hundred ".to_word($number%100);
        }
        else if($number<2000)
        {
            $words = "seribu ".to_word($number-1000);
        }
        else if($number<1000000)
        {
            $words = to_word($number/1000)." Thousand ".to_word($number%1000);
        }
        else if($number<1000000000)
        {
            $words = to_word($number/1000000)." Million ".to_word($number%1000000);
        }
        else
        {
            $words = "undefined";
        }
        return $words;
    }

    function comma($number)
    {
        $after_comma = stristr($number,'.');
        $arr_number = array(
        "Zero",
        "One",
        "Two",
        "Three",
        "Four",
        "Five",
        "Six",
        "Seven",
        "Eight",
        "Nine");
        
        $results = "";
        $length = strlen($after_comma);
        $i = 1;
        while($i<$length)
        {
            $get = substr($after_comma,$i,1);
            $results .= " ".$arr_number[$get];
            $i++;
        }
        return $results;
    }
}
