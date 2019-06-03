<?php
/**
 * Created by PhpStorm.
 * User: zerto
 * Date: 31/05/2019
 * Time: 11:01
 */

namespace App\Service;


class Slugify
{

    public function generate(string $input): string
    {
        $input = str_replace(' ', '-', $input);
        $caracteres = ['À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a', 'à' => 'a', 'á' => 'a', 'ä' => 'a',
            'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
            'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
            'Œ' => 'oe', 'œ' => 'oe', 'ç' => 'c'];


        $input = str_replace(array_keys($caracteres), array_values($caracteres), $input);
        $input = preg_replace('/[^A-Za-z0-9-]/', '', $input);
        $input = preg_replace('/-+/', '-', $input);
        $input = trim($input, '-');


        return strtolower($input);
    }

}