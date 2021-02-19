<?php
    include "parse.class.php";
    include "IPP21.spec.php";

    $parser = new parse('php://stdin', $IPP21_LANG);

    $test = $parser->parse();
    print_r(json_decode(json_encode($test)));
?>