<?php

include_once 'console.php'; //allow syntax color only run on powershell


error_reporting(0); // avoid warning + useless error

//TO DO : 10 algo differents to find


print Console::cyan(" ______________________________________________________________________________ ") . PHP_EOL . PHP_EOL;
print   Console::cyan(" |||||");
print Console::light_red(" PLEASE DO NOT RUN THIS SCRIPT ON CMD FOR A CORRECT SYNTAX RENDER !") . Console::cyan(" |||||") . PHP_EOL;;
print   Console::cyan(" |||||");
print Console::light_red(" / dont forget to used '', ex :'...yourHash' for your CLI params ! \\") . Console::cyan("|||||") . PHP_EOL;;
print Console::cyan(" ______________________________________________________________________________ ") . PHP_EOL . PHP_EOL;

print PHP_EOL;
print PHP_EOL;


$list_algo = [6 => "CRC16", 8 => "Adler32", 32 => "md5", 40 => "sha1", 128 => "whirlpool"];


// [ bits => length (octet) ] => strlen(x) * 4, give bits value for x
$list_algo_bits =
    [
        320 => 80, /* RipMD320 */
        256 => 64, /* Snefru256 */
        224 => 56, /* SHA224 */
        192 => 48, /* Tiger192 - 4 Rounds */
        /* 13 .. */

        //Implementer into LIST !!! for each new algo

    ];


// BCRYPT
/*
$ 2int $ 2int $ 21 $ pass
http://php.net/manual/fr/faq.passwords.php
*/


//DOC
if ($argv[1] == '--help') {

    echo "  _____________________________ HELP _____________________________";
    echo PHP_EOL;
    echo PHP_EOL;
    echo PHP_EOL;

    echo " 1. RUN ONLY ON POWERSHELL OR UNIX SHELL (do not use CMD) !";
    print PHP_EOL;
    print PHP_EOL;

    echo " 2. Run (WINDOWS) : php .\\hashid.php argv " . PHP_EOL;
    echo PHP_EOL;
    echo "      argv =>  hash : String only (dont forget to use '') " . PHP_EOL;
    echo PHP_EOL;
    echo "              --help : Display rules" . PHP_EOL;
    echo PHP_EOL;
    echo "              --john  : Generate the command John the ripper" . PHP_EOL;
    echo PHP_EOL;
    echo "              --list : Display the list of algorithms of hash" . PHP_EOL;

    print PHP_EOL;
    print PHP_EOL;
    echo " 3. console.php MUST BE AT THE ROOT OF YOUR PROJECT (Allow the syntax color for CLI php into terminal) !";
    print PHP_EOL;
    print PHP_EOL;

    print PHP_EOL;
    print PHP_EOL;
    echo " 4. Require internet (cURL for wikipedia)";
    print PHP_EOL;
    print PHP_EOL;
    print PHP_EOL;
    print PHP_EOL;
}


//option ou en simple commande ???
if ($argv[1] == '--john') {

    echo "  _____________________________ JOHN THE RIPPER _____________________________";
    echo PHP_EOL;
    echo PHP_EOL;
    echo PHP_EOL;
    echo PHP_EOL;


    echo " // Infos \\\\" . PHP_EOL;
    echo PHP_EOL;
    echo Console::green("John est capable de casser differents formats de chiffrement de mots de passe, notamment les mots de passe crypt (Unix), MD5, Blowfish, Kerberos, AFS, et les LM hashes de Windows NT/2000/XP/2003. Des modules additionnels sont disponibles pour lui permettre de casser les mots de passe basés sur les hash MD4 et les mots de passe enregistrés dans MySQL ou LDAP, ainsi que les mots de passe NTLM, pour les dernières versions de Windows.
Il n'est pas necessaire d'avoir un acces physique sur la machine a auditer, tant qu'on dispose d'un fichier dans lequel sont enregistres les mots de passe chiffres.
");

    echo PHP_EOL;
    echo PHP_EOL;


    //Choose your file.txt
    //...
    echo "Enter the name of your file (dont forget .txt) [Type the name to continue]: ";
    $handle = fopen("php://stdin", "r");
    $filename = fgets($handle);
    echo "file choose : " . $filename;
    fclose($handle);
    echo "\n";

    echo "Type 0 1 2 for your mod => [single, wordlist, incremental]: ";
    $mod = [0 => "single", 1 => "wordlist", 2 => "incremental"];

    $handle = fopen("php://stdin", "r");
    $numberChoix = fgets($handle);
    //echo "Mod : " . $mod[$numberChoix];
    fclose($handle);
    echo "\n";

    //cas dico, ask for the dico file too
    if ($numberChoix == 1) {
        echo "Enter the name of your wordlist file (dont forget .lst) [Type the name to continue]: ";
        $handle = fopen("php://stdin", "r");
        $dico = fgets($handle);
        echo "file choose : " . $dico;
        fclose($handle);
        echo "\n";
    } else {
        $dico = "";
    }

    if ($numberChoix == 2) {
        echo "Type 0 1 2 for your mod => [alpha, digit, all]:";
        $handle = fopen("php://stdin", "r");
        $optionIncrement = fgets($handle);
        echo "Option : " . $optionIncrement;
        fclose($handle);
        echo "\n";
    } else {
        $optionIncrement = "";
    }


    echo "Enter the password to crack : ";
    $handle = fopen("php://stdin", "r");
    $passwordToCrack = fgets($handle);
    echo "password  : " . $passwordToCrack;
    fclose($handle);
    echo "\n";

    echo PHP_EOL;
    echo "          ...            ";
    echo PHP_EOL;

    //WRITE GENERATE CHAIN
    switch ($numberChoix) {
        case 0:
            echo PHP_EOL;
            echo "john --single " . $filename;
            echo PHP_EOL;
            echo "john --si " . $filename;
            echo PHP_EOL;
            break;
        case 1:
            echo PHP_EOL;
            echo "john ––wordlist=" . $dico . " " . $filename;
            echo PHP_EOL;
            echo "john ––w=" . $dico . " " . $filename;
            echo PHP_EOL;
            break;
        case 2:
            switch ($optionIncrement) {
                case 0:
                    echo PHP_EOL;
                    echo "john ––i:alpha " . $filename;
                    echo PHP_EOL;
                    break;
                case 1:
                    echo PHP_EOL;
                    echo "john ––i:digit " . $filename;
                    echo PHP_EOL;
                    break;
                case 2:
                    echo PHP_EOL;
                    echo "john ––i:all " . $filename;
                    echo PHP_EOL;
                    break;
                default:
                    echo PHP_EOL;
                    echo "john ––incremental " . $filename;
                    echo PHP_EOL;
                    break;
            }
            break;
        default:
            print " Something wrong happend, please retry :( ";
            break;
    }

}

//Display list of algo
if ($argv[1] == '--list') {
    echo "  _____________________________ LIST _____________________________";
    $list = ["CRC16", "Adler32", "Bcrypt", "MD5", "SHA1", "whirlpool", "RipMD320", "Snefru256", "SHA224"];

    echo PHP_EOL;
    echo PHP_EOL;
    echo PHP_EOL;

    foreach ($list as $algoName) {
        echo " " . $algoName . PHP_EOL;
    }
    echo PHP_EOL;
    echo PHP_EOL;
    echo PHP_EOL;
}


//Error => invalid hash
if (is_string($argv[1]) == false) {
    print Console::red("Please enter a valid hash in CLI param ! (Dont forget to use '' => '... your hash' )");
    print PHP_EOL;
    print PHP_EOL;
    print PHP_EOL;
    return 0;
}


// cURL wikipedia (not option, automaticly call when an hash is enter)
function wikipedia($nameHash)
{
    switch ($nameHash) {
        case "Bcrypt":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=bcrypt&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "CRC16":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=crc16&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "Adler32":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=Adler32&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "md5":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=md5&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "sha1":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=sha1&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "whirlpool":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=whirlpool&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "ripmd":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=ripmd&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "snefru":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=snefru&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "sha224":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=sha1&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        case "tiger":
            echo PHP_EOL;
            $url = "https://en.wikipedia.org/w/api.php?action=query&prop=extracts|info&exintro&titles=Tiger_(cryptography)&format=json&explaintext&redirects&inprop=url";
            $json = file_get_contents($url);
            $data = json_decode($json, TRUE);
            $titles = array();
            foreach ($data['query']['pages'] as $page) {
                $titles[] = $page['extract'];
            }
            echo PHP_EOL;
            echo " Extract from wikipedia : " . $titles[0];
            echo PHP_EOL;
            break;
        default:
            echo PHP_EOL;
            echo " No data found from wikipedia";
            echo PHP_EOL;
            break;


    }
}


//if param dosnt begin by --
if ($argv[1][0] != "-" || $argv[1][1] != "-") {


    if ($argv[1][0] == "$" && $argv[1][3] == "$" && $argv[1][6] == "$") {

        $salt = [];

        print Console::yellow(" Bcrypt");
        print PHP_EOL;
        for ($x = 6; $argv[1][$x] != "."; $x++) {
            array_push($salt, $argv[1][$x]); //add all between 3 $ and . (salt)
        }
        array_push($salt, "."); //add point of salt

        $displaySalt = implode("", $salt);
        print Console::light_green(" Salt : " . $displaySalt);
        echo PHP_EOL;

        wikipedia("Bcrypt");

        return 0;
    }
    $hash_length = strlen($argv[1]);

    print PHP_EOL;
    print PHP_EOL;
    print Console::yellow(" " . $list_algo[$hash_length]);
    print PHP_EOL;
    wikipedia($list_algo[$hash_length]);

    print PHP_EOL;
    print PHP_EOL;

    //if find nothing try another list of 15 algo
    if ($list_algo[$hash_length] == "") {

        print Console::green(" Try to find for ") . Console::light_green("" . $argv[1] . " . . ." . "") . PHP_EOL;
        print PHP_EOL;
        print PHP_EOL;
        print PHP_EOL;
        print PHP_EOL;
        print PHP_EOL;


        //$hash_length == strlen(argc)
        $hash_bits = $hash_length * 4; // convert into bits

        switch ($list_algo_bits[$hash_bits]) {
            case 80:
                print PHP_EOL;
                print Console::yellow(" RipMD") . Console::light_green('' . $hash_bits);
                print PHP_EOL;
                print PHP_EOL;
                wikipedia("ripmd");
                print PHP_EOL;
                print PHP_EOL;
                break;
            case 64:
                print PHP_EOL;
                print Console::yellow(" Snefru") . Console::light_green('' . $hash_bits);
                print PHP_EOL;
                print PHP_EOL;
                wikipedia("snefru");
                print PHP_EOL;
                print PHP_EOL;
                break;
            case 56:
                print PHP_EOL;
                print Console::yellow(" SHA") . Console::light_green('' . $hash_bits);
                print PHP_EOL;
                print PHP_EOL;
                wikipedia("sha224");
                print PHP_EOL;
                print PHP_EOL;
                break;
            case 48:
                print PHP_EOL;
                print Console::yellow(" Tiger") . Console::light_green('' . $hash_bits);
                print PHP_EOL;
                print PHP_EOL;
                wikipedia("tiger");
                print PHP_EOL;
                print PHP_EOL;
                break;

            default:
                print Console::light_red(" /!\\ Im sorry, 0 algorithms matched with that hash :( ");
                print PHP_EOL;
                print PHP_EOL;
                break;
        }
    }
}


