<?php
/**
 * File add support for PHP7.4
 * @autor Lukáš Plevač <xpleva07@vutbr.cz>
 * @date 9.3.2020
 */
    if (version_compare(PHP_VERSION, '8.0.0', '<')) {

        /**
         * Zkontroluje zda string začíná $need (náhrada za funkci str_starts_with() z PHP 8)
         * @param $str string ve kterém hledáme začátek
         * @param $need začátek který potřebujeme
         * @return bool
         */
        function str_starts_with($str, $need) {
            return  substr($str, 0, strlen($need)) === $need;
        }
    }
?>
