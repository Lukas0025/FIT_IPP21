<?php
    include "parse.class.php";
    include "xml.namespace.php";
    include "IPP21.spec.php";

    if ($argc > 1) {
        echo "IPP CODE 21 PARSER\n";
        echo "\n";
        echo "connect source to stdin and on stdout is XML output\n";
        exit(0);
    }

    $parser = new parse('php://stdin', $IPP21_LANG);

    $parsed = $parser->parse();
    echo xml_dump($parsed);
?>