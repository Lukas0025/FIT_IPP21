Implementační dokumentace k 1. úloze do IPP 2020/2021
Jméno a příjmení: Lukáš Plevač
Login: xpleva07

## Popis

Script je určený pro překlad z jazyka IPPcode21 do XML reprezentace tohoto kódu pro další zpracování. Při překladu se provádí syntaktická i lexikální analíza.

## Soubory projektu

* IPP21.spec.php - obsahuje specifikaci jazyka IPP21 popsané pomocí array
* parse.class.php - obsahuje třídy popisující funkci perseru
* xml.namespace.php - obsahuje pomocné funkce pro generoání výstupního XML
* parse.php - TOP soubor implementace spojuje výše uvedené soubory. slouží jako spustitelný soubor

## Třídy

* appError - Obsahuje statické metedy pro ukončení scriptu se specifickou chybou
* argument - Popisuje argument instrukce při consructoru zjistý typ atributu a ověří zda je validní
* instruction - Popisuje instrukci při conscructoru provede ověření operačního kódu a parametry předává novému objektu třídy argument pro zpracování
* parse - TOP třída představující parser dále využívá objektů tříd argument a inscruction

## Obecné fungování parseru

vstup se čte po řádcích. Nejdříve se hledá hlavička ta se hledá tak že se na prvním řádku očekává, pokud tam není tak se nahlásí chyba, ale pouze v případě že na řádku je něco jiného než whispace a kometář, pokud ne tak se řádek peskočí a následující se považuje za první. poté se již parsují příkazy. ty se parsují tak že se načte řádek rozdělí se podle white spaces pokud je na řádku # tak se vše dál od něj ignoruje. rozdělené části se pak kontrolují tak že 0. prvek se považuje že je instrukce a zjistuje se zda se opravu jedná o intrukci, pokud ne skončí s chybou. nsledně se parsují parametry a to tak že se nejdříve porovná jeich očet s očekávaným počtem, pokud neprojde opět aplikace se ukončí. parametry se pak následně parsují o jednom pro ověření zda je jedná o předpokládáný typ pro instrukci na určité pozici, jako poslední část se kontroluje zda hodnota odpovídá požadavkům na typ

## Rozšíření

### todo