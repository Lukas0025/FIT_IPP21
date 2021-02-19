<?php

    /**
     * Třída popisující argument instrukce
     */
    class argument {

        /**
         * argument constructor - načte arument ze slova
         * @param str $word - náš argument
         * @param str $instruction - jméno instrukce pro kterou argument je
         * @param int $index - index argumentu (pozice argumentu)
         * @param array $language - struktuta popisujíí jazyk
         * @post 
         *      - vytvoří $this->type s dat typem argumentu
         *      - vytvoří $this->data s daty argumentu
         */
        function __construct($word, $instruction, $index, $language) {
            $meta  = $language["instructions"][$instruction];

            //get type
            $this->type = $this->get_type($word);

            $this->data = $word;

            //todo: check type
        }

        /**
         * Vrátí typ slova
         * @param str $word
         * @return str $type (var, str, int, float, bool, label)
         */
        private function get_type($word) {
            if (str_starts_with($word, "GF@") || str_starts_with($word, "LF@") || str_starts_with($word, "TF@")) {
                return "var";
            } else if (str_starts_with($word, "string@")) {
                return "str";
            } else if (str_starts_with($word, "int@")) {
                return "int";
            } else if (str_starts_with($word, "float@")) {
                return "float";
            } else if (str_starts_with($word, "bool@")) {
                return "bool";
            } else {
                return "label";
            }
        }
    }

    /**
     * Třída popisující instrukci
     */
    class instruction {

        private $language;

        /**
         * instruction constructor - načte instrukci ze zpracovaného řádku
         * @param str $parsed_line - zpracovaný řádek pomocí parse::line_parse
         * @param array $language - struktuta popisujíí jazyk
         * @post 
         *      - vytvoří $this->instruction se zněním instrikce
         *      - vytvoří $this->op se zněním op code instrikce
         *      - vytvoří $this->args s array obsahující instance třídy argument
         */
        function __construct($parsed_line, $language) {

            $this->language = $language;
            
            if (!$this->haveOP($parsed_line[0])) {
                echo "no op " . $parsed_line[0];
                exit(1);
            }

            $this->instruction = strtoupper($parsed_line[0]);
            $this->op                = $this->language["instructions"][$this->instruction]['op'];

            if ((count($parsed_line) - 1) <> $this->language["instructions"][$this->instruction]['args_count']) {
                echo "bad args count " . $parsed_line[0];
                exit(1);
            }
            
            $this->args            = [];
            for($i = 1; $i < count($parsed_line); $i++) {
                array_push($this->args, new argument($parsed_line[$i], $this->instruction, $i, $this->language));
            } 
        }

        /**
         * Zkontroluje za je slovo instrukcí (zda mí OP Code)
         * @param str word (instruction)
         * @return bool
         */
        private function haveOP($word) {
            return array_key_exists($word, $this->language["instructions"]);
        }

    }

    /**
     * Třída popisující parser (používá třídy instruction a argument)
     */
    class parse {

        private $language;

        /**
         * parse constructor - zpracuje stream a rozdělí na instrukce
         * @param str $stream - cesta k souboru (default: php://stdin)
         * @param array $language - struktuta popisujíí jazyk
         * @post 
         *      - vytvoří $this->stream s otevřeným streamem k souboru $stream
         *      - vytvoří $this->language s kopií $language
         */
        function __construct($stream = 'php://stdin', $language) {
            $this->stream      = fopen($stream, 'r' );
            $this->language  = $language;
        }

        function __destruct() {
            fclose($this->stream);
        }

        private function line_parse($line) {
            $line .= " "; // přidání mezery na konec pro spráné parsování bez ní může být vynecháno podledn slovo

            $words = [];
            $cur_word = "";

            foreach (str_split($line) as $char) {

                if (ctype_space($char)) {
                    if ($cur_word <> "") {
                        array_push($words, $cur_word);

                        $cur_word = "";
                    }
                } else {
                    //je to komentář
                    if ($char == "#") {
                        if ($cur_word <> "") {
                            array_push($words, $cur_word);
                        }

                        break;
                    } 

                    $cur_word .= $char;
                }

            }

            return  $words;

        }

        /**
         * Provede zpracování streamu po řádcích voláním instrukce new instruction nad line_parse
         * @return array obsahující instance třídy instruction
         */
        public function parse() {
            $commands = [];
            $line_num     = 0;

            while ( $line = fgets($this->stream ) ) {
                //hlavička
                if ($line_num == 0) {
                    if (strtoupper(preg_replace('/\s+/', '', $line) ) <> ".IPPCODE21") {
                        echo "bad header ". $line;
                        exit(1);
                    }

                    $line_num++;
                    continue;
                }

                $parsed_line = $this->line_parse($line);

                if (count($parsed_line) > 0) {
                    array_push($commands, new instruction($parsed_line, $this->language));
                }

                $line_num++;
            }

            return $commands;
        }

    }
?>