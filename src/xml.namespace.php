<?php

    /**
     * Převede array instrukcí na odpovádající XML kód
     * @param array $instructions - array instrukcí
     * @return str XML
     */
    function xml_dump($instructions) {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><program/>');

        $xml->addAttribute("language", "IPPcode21");

        foreach ($instructions as $index => $instruction) {
            $instruction_obj = $xml->addChild('instruction');

            $instruction_obj->addAttribute("order", $index);
            $instruction_obj->addAttribute("opcode", $instruction->op);

            foreach ($instruction->args as $key => $arg) {
                if ($arg->type == "var") {
                    $arg_ob = $instruction_obj->addChild('arg' . ($key + 1), $arg->raw);
                } else {
                    $arg_ob = $instruction_obj->addChild('arg' . ($key + 1), $arg->value);   
                }
                
                $arg_ob->addAttribute("type", $arg->type);
            }

        }

        return $xml->asXML();

    }
?>