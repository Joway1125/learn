<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
/*function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        }
        if(!$middle) {
            return substr($string, 0, $length) . $etc;
        } else {
            return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        }
    } else {
        return $string;
    }
}*/

function smarty_modifier_truncate($string, $length = 80, $etc = '...',$break_words = false)
{
if ($length == 0)
       return '';
if (strlen($string) > $length)
{
       $length -= strlen($etc); 
       if (!$break_words)
       $string = preg_replace('/s+?(S+)?$/', '', SubstrGB($string, 0, $length+1));
   
       return SubstrGB($string, 0, $length).$etc;
} else
       return $string;
}
function SubstrGB($str,$start,$len)
{//$str:字符串,$start:开始的位置,$len :截取长度
if( strlen($str) > $len)
{
$strlen=$strart+$len;
for($i=0;$i<$strlen;$i++)
{
if(ord(substr($str,$i,1))>0xa0)
{
$tmpstr.=substr($str,$i,2);
$i++;
}
else
{
$tmpstr.=substr($str,$i,1);
}
}
return $tmpstr;
}
else
{
return $str;
}
}

/* vim: set expandtab: */

?>
