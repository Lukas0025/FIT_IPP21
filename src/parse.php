<?php
    include "parse.class.php";
    include "xml.namespace.php";
    include "IPP21.spec.php";

    $parser = new parse('php://stdin', $IPP21_LANG);

    $parsed = $parser->parse();
    echo xml_dump($parsed);
?>