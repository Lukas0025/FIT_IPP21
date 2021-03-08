<?php

    class appError {
        public static function param($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (10);
        }

        public static function inputFile($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (11);
        }

        public static function outputFile($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (12);
        }

        public static function header($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (21);
        }

        public static function operation($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (22);
        }

        public static function lexOrSyntax($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (23);
        }

        public static function general($msg) {
            fwrite(STDERR, $msg . PHP_EOL);
            exit (99);
        }
    }

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
            $this->parse($word);
        }

        /**
         * Vrátí typ slova a hodnotu
         * @param str $word
         * @return null
         * @post set $this->type (var, str, int, float, bool, label)
         * set $this->value
         */
        private function parse($word) {
            if (str_starts_with($word, "GF@") || str_starts_with($word, "LF@") || str_starts_with($word, "TF@")) {
                $this->type = "var";
                $this->value = substr($word, 3);
            } else if (str_starts_with($word, "string@")) {
                $this->type = "str";
                $this->value = substr($word, 7);
            } else if (str_starts_with($word, "int@")) {
                $this->type = "int";
                $this->value = substr($word, 4);
            } else if (str_starts_with($word, "nil@")) {
                $this->type = "nil";
                $this->value = substr($word, 4);
            } else if (str_starts_with($word, "bool@")) {
                $this->type  = "bool";
                $this->value = substr($word, 5);
            } else {
                $this->type   = "label";
                $this->value = $word;
            }

            $this->valueCheck($this->type, $this->value);

            $this->raw = $word;
        }

        private function valueCheck($type, $value) {
            switch ($type) {
                case "bool":
                    if ($value != "true" && $value != "false") {
                        appError::lexOrSyntax("neznámá hodnota pro typ bool " . $value);
                    }
                    break;

                case "var":
                    if (!$this->isValidLable($value)) {
                        appError::lexOrSyntax("neplatný identifikátor proměnné " . $value);
                    }
                    break;

                case "lable":
                    if (!$this->isValidLable($value)) {
                        appError::lexOrSyntax("neplatné návještí " . $value);
                    }
                    break;

                case "int":
                    if (!is_int($value)) {
                        appError::lexOrSyntax("neplatné číslo typu int " . $value);
                    }

                /*case "str":
                    if (!is_int($value)) {
                        appError::lexOrSyntax("neplatné číslo typu int " . $value);
                    }*/
            }
        }

        private function isValidLable($value) {
            return preg_replace("/[a-zA-Z0-9_\-$&%*!?]/", '', $value)  == "";
            return true;
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
                appError::operation("neznámá instrukce " . $parsed_line[0]);
            }

            $this->instruction = strtoupper($parsed_line[0]);
            $this->op                = $this->language["instructions"][$this->instruction]['op'];

            if ((count($parsed_line) - 1) <> $this->language["instructions"][$this->instruction]['args_count']) {
                appError::param("špatný počet argumentů pro instrukci " . $parsed_line[0]);
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
                    if (preg_replace('/(\s)*\.IPPCODE21(\s)*/', '', strtoupper($line))  <> "") {
                        if ($line[0] != "#") {
                            appError::header("špatná hlavička " . $line);
                        }
                    } else {
                        $line_num++;
                    }

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