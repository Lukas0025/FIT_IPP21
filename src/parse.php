<?php
    include "parse.class.php";
    include "xml.namespace.php";
    include "IPP21.spec.php";

    if (count($argv) == 2) {

        if ($argv[1] == "--help")  {
            echo "IPP CODE 21 PARSER\n";
            echo "\n";
            echo "connect source to stdin and on stdout is XML output\n";
            exit(0);
        }

        exit(10);

    } else if (count($argv) > 2) {
        exit(10);
    }

    $parser = new parse('php://stdin', $IPP21_LANG);

    $parsed = $parser->parse();
    echo xml_dump($parsed);
?>