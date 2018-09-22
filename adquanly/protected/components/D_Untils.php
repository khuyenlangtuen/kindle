<?php
class D_Untils 
{
     public function truncateString_utf8($str, $len, $charset="UTF-8"){
        $str = html_entity_decode($str, ENT_QUOTES, $charset);
        if(mb_strlen($str, $charset)> $len){
            $arr = explode(' ', $str);
            $str = mb_substr($str, 0, $len, $charset);
            $arrRes = explode(' ', $str);
            $last = $arr[count($arrRes)-1];
            unset($arr);
            if(strcasecmp($arrRes[count($arrRes)-1], $last))   unset($arrRes[count($arrRes)-1]);
          return implode(' ', $arrRes)."...";
       }
        return $str;
    }
    static function len($input){
        return preg_match_all('/[\x01-\x7F]|[\xC0-\xDF][\x80-\xBF]|[\xE0-\xEF][\x80-\xBF][\x80-\xBF]/', $input, $arr);
    }
    public static function convertToAlias($value) {
        $value = preg_replace("/(“|”)/", '', $value);
        $value = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $value);
        $value = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $value);
        $value = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $value);
        $value = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $value);
        $value = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $value);
        $value = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $value);
        $value = preg_replace("/(đ)/", 'd', $value);
        $value = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $value);
        $value = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $value);
        $value = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $value);
        $value = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $value);
        $value = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $value);
        $value = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $value);
        $value = preg_replace("/(Đ)/", 'D', $value);
        $value = strtolower($value);
        $value = str_replace("#", " ", $value);
        $value = str_replace("$", " ", $value);
        $value = str_replace("%", " ", $value);
        $value = str_replace("&", " ", $value);
        $value = str_replace("/", " ", $value);
        $value = str_replace("\\", " ", $value);
        $value = str_replace("*", " ", $value);
        $value = str_replace("@", " ", $value);
        $value = str_replace(")", " ", $value);
        $value = str_replace("(", " ", $value);
        $value = str_replace("}", " ", $value);
        $value = str_replace("{", " ", $value);
        $value = str_replace("[", " ", $value);
        $value = str_replace("]", " ", $value);
        $value = str_replace("-", " ", $value);
        $value = str_replace("+", " ", $value);
        $value = str_replace(".", " ", $value);
        $value = str_replace(":", " ", $value);
        $value = str_replace(",", " ", $value);
        $value = str_replace("?", " ", $value);
        $value = str_replace("!", " ", $value);
        $value = str_replace("'", " ", $value);
        $value = str_replace("\"", " ", $value);
        $value = str_replace("â€", " ", $value);
        $value = str_replace("â€", " ", $value);
        $value = str_replace("96;", " ", $value);
        $value = str_replace("gt;", " ", $value);
        $value = str_replace("~", " ", $value);
        $value = str_replace("<", " ", $value);
        $value = str_replace("^", " ", $value);

        $value = preg_replace("/[\s]+/", "-", trim($value));
        $value = preg_replace("/[-]+$/", "", $value);
        $value = preg_replace("/^[-]+/", "", $value);
        return $value;
    }
    static function generateUrlSlug($string, $maxlen = 0) {
        $string = self::convertToAlias($string);
        $string = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($string)), '-');
        if ($maxlen && self::len($string) > $maxlen) {
            $string = substr($string, 0, $maxlen);
            $pos = strrpos($string, '-');
            if ($pos > 0) {
                $string = substr($string, 0, $pos);
            }
        }
        return $string;
    }
    // Returns the distance of time in words between two dates
    function distance_of_time_in_words($from_time, $to_time = null, $include_seconds = false)
    {
      $to_time = $to_time? $to_time: time();
     
      $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
      //$distance_in_seconds = floor(abs($to_time - $from_time));
     
      $string = '';
      $parameters = array();
     
      /*if ($distance_in_minutes <= 1)
      {
        if (!$include_seconds)
        {
          $string = $distance_in_minutes == 0 ? 'less than a minute' : '1 minute';
        }
        else
        {
          if ($distance_in_seconds <= 5)
          {
            $string = 'less than 5 seconds';
          }
          else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
          {
            $string = 'less than 10 seconds';
          }
          else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
          {
            $string = 'less than 20 seconds';
          }
          else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
          {
            $string = 'half a minute';
          }
          else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
          {
            $string = 'less than a minute';
          }
          else
          {
            $string = '1 minute';
          }
        }
      }*/
      if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
      {
        $string = '%minutes% minutes';
        $parameters['%minutes%'] = $distance_in_minutes;
      }
      else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
      {
        $string = 'about 1 hour';
      }
      else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
      {
        $string = 'about %hours% hours';
        $parameters['%hours%'] = round($distance_in_minutes / 60);
      }
      else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
      {
        $string = '1 day';
      }
      else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
      {
        $string = '%days% days';
        $parameters['%days%'] = round($distance_in_minutes / 1440);
      }
      else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
      {
        $string = 'about 1 month';
      }
      else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
      {
        $string = '%months% months';
        $parameters['%months%'] = round($distance_in_minutes / 43200);
      }
      else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
      {
        $string = 'about 1 year';
      }
      else
      {
        $string = 'over %years% years';
        $parameters['%years%'] = floor($distance_in_minutes / 525960);
      }
     
      return strtr($string, $parameters);
    }
}




