<?php

function string_slug($string, $separator = '-')
{
    return str_slug($string, $separator, false);
}

function string_grouping($string_array)
{
    $data = [];
    foreach ($string_array as $string) {
        $needle=NULL;
        foreach(trans('permissions.modules') as $module) {
            if(ends_with($string,$module)) {
                $needle = $module;
            }
        }
        if($needle) {
            foreach($string_array as $i => $str) {
                if(str_contains( $str , $needle )) {
                    $sub_str = str_replace_first( $needle , '' ,$str );
                    if($sub_str != "") {
                        $data[$needle][$str] = $sub_str;
                    }else {
                        $data[$needle] = $needle;
                    }
                    unset($string_array[$i]);
                }
            }
        }
    }
    return $data;
}
