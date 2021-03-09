<?php
/**
 * Hlavní soubor scriptu slouží jako spustitelný soubor
 * @autor Lukáš Plevač <xpleva07@vutbr.cz>
 * @date 9.3.2020
 */
    include "parse.class.php";
    include "xml.namespace.php";
    include "IPP21.spec.php";
    //if run under php 7.4 else comment it
    include "php8.support.php";

    ini_set('display_errors', 'stderr');

    if (count($argv) == 2) {

        if ($argv[1] == "--help")  {
            echo "Skript typu filtr načte ze standardního vstupu zdrojový kód v IPPcode21,\n"
                       . "zkontroluje lexikální a syntaktickou správnost kódu a vypíše na standardní výstup XML reprezentaci programu\n";
            exit(0);
        }

        appError::param("nesprávné argumenty. --help pro pomoc");

    } else if (count($argv) > 2) {
        appError::param("nesprávné argumenty. --help pro pomoc");
    }

    $parser = new parse('php://stdin', $IPP21_LANG);

    $parsed = $parser->parse();
    echo xml_dump($parsed);
?>