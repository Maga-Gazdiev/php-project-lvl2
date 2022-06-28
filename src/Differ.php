<?php

namespace new\space;

use Symfony\Component\Yaml\Yaml;

function keys($file)
{
    $str = file_get_contents($file);
    $json = (json_decode($str));
    $result = [];
    foreach ($json as $key => $item) {
        $result[$key] = $item;
    }
    return $result;
}

function typp($file){
if(substr($file, -4) === 'json'){
  return keys($file);
}elseif(substr($file, -3) === 'yml' || substr($file, -4) === 'yaml'){
  return Yaml::parseFile($file);
}
}

function gendiff($firstFile, $secondFile, $format = "stylish")
{
    $json1 = typp($firstFile);
    $json2 = typp($secondFile);
    $stac = [];
    $stac1 = [];
    foreach ($json1 as $keys1 => $item1) {
        foreach ($json2 as $keys2 => $item2) {
            if ($item1 === true) {
                array_push($stac, "- $keys1: true");
            } elseif ($item2 === true) {
                array_push($stac, "+ $keys2: true");
            }
            if ($keys1 === $keys2 && $item1 !== $item2) {
                array_push($stac, "+ $keys2: $item2");
                array_push($stac, "- $keys1: $item1");
            }
            if (!array_key_exists($keys2, $json1) && $item2 !== true && $item2 !== false) {
                array_push($stac, "+ $keys2: $item2");
            } elseif (!array_key_exists($keys1, $json2) && $item1 !== true && $item1 !== false) {
                array_push($stac, "- $keys1: $item1");
            }
            $repeats = array_unique($stac);
            $upheaval = array_reverse($repeats);
            if ($item1 === false) {
                array_push($stac1, "- $keys1: false");
            } elseif ($item1 === false) {
                array_push($stac1, "+ $keys2: false");
            } elseif ($keys1 === $keys2 && $item1 === $item2) {
                array_push($stac1, "  $keys1: $item1");
            }
            $repeats1 = array_unique($stac1);
            $upheaval1 = array_reverse($repeats1);
            $merge = array_merge($upheaval1, $upheaval);
            $implode = implode("\n", $merge);
        }
    }
    return $implode;
}
