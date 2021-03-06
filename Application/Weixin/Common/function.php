<?php
/**
 * Created by Green Studio.
 * File: function.php
 * User: TianShuo
 * Date: 14-2-18
 * Time: 下午1:58
 */

function getRealText($keyword)
{
    if ($keyword == 'text')
        return '文本';
    elseif ($keyword == 'click') {
        return '点击';
    } elseif ($keyword == 'view') {
        return '直链';
    } elseif ($keyword == 'news') {
        return '图文';
    } elseif ($keyword == 'text') {
        return '文本';
    } elseif ($keyword == 'image') {
        return '图片';
    } elseif ($keyword === 0) {
        return '已';
    } elseif ($keyword === 1) {
        return '未';
    } else {
        return '';
    }

}

function getMenuButtons()
{
    $menu = trim(C('Weixin_menu'));

    $menu = json_decode($menu, true);
    $array = $menu['button'];

    static $result_array = array();
    foreach ($array as $value) {
        if ($value['name'] != '' && $value['key'] != '') {
            $result_array [$value['key']] = $value['name'];
        }
        if (!empty($value['sub_button'])) {
            foreach ($value['sub_button'] as $value2) {
                if ($value2['name'] != '' && $value2['key'] != '') {
                    $result_array [$value2['key']] = $value2['name'];
                }
            }
        }
    }
    return $result_array;
}




/**
 *
 * @package 二维数组排序
 * @version $Id: FunctionsMain.inc.php,v 1.32 2005/09/24 11:38:37 wwccss Exp $
 *
 *
 *          Sort an two-dimension array by some level two items use
 *          array_multisort() function.
 *
 *
 *
 *          sysSortArray($Array,&quot;Key1&quot;,&quot;SORT_ASC&quot;,&quot;SORT_RETULAR&quot;,&quot;Key2&quot;……)
 * @param array $ArrayData
 *            the array to sort.
 * @param string $KeyName1
 *            the first item to sort by.
 * @param string $SortOrder1
 *            the order to sort by(&quot;SORT_ASC&quot;|&quot;SORT_DESC&quot;)
 * @param string $SortType1
 *            the sort
 *            type(&quot;SORT_REGULAR&quot;|&quot;SORT_NUMERIC&quot;|&quot;SORT_STRING&quot;)
 * @return array sorted array.
 */
function sysSortArray($ArrayData, $KeyName1, $SortOrder1 = "SORT_ASC", $SortType1 = "SORT_REGULAR")
{
    if (!is_array($ArrayData)) {
        return $ArrayData;
    }

    // Get args number.
    $ArgCount = func_num_args();

    // Get keys to sort by and put them to SortRule array.
    for ($I = 1; $I < $ArgCount; $I++) {
        $Arg = func_get_arg($I);
        if (!eregi("SORT", $Arg)) {
            $KeyNameList [] = $Arg;
            $SortRule [] = '$' . $Arg;
        } else {
            $SortRule [] = $Arg;
        }
    }

    // Get the values according to the keys and put them to array.
    foreach ($ArrayData as $Key => $Info) {
        foreach ($KeyNameList as $KeyName) {
            ${$KeyName} [$Key] = $Info [$KeyName];
        }
    }

    // Create the eval string and eval it.
    $EvalString = 'array_multisort(' . join(",", $SortRule) . ',$ArrayData);';
    eval ($EvalString);
    return $ArrayData;
}


function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function('$matches', 'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'), $str);
}


function array_insert(&$array, $position, $insert_array)
{
    $first_array = array_splice($array, 0, $position);

    array_push($first_array, $insert_array);
    $array = array_merge($first_array, $array);
}

function get_alink($url){

    if(empty($url))return '';
    else return '<a href="'.$url.'">点击查看</a>';
}