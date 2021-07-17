<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <title>BatchInfoLoad</title>
 </head>
 <body>

  
<?php
require_once '../config.php';
require_once '../amazonRequest.php';

$separator = array('tab' => "\t", 'space' => " ", 'semicolon' => ";");
//input
if ($_POST['col_sep'] == 'other')
    $inputSep = htmlspecialchars($_POST['col_sep_other']);
else
    $inputSep = $separator[$_POST['col_sep']];

$colISBN = intval(htmlspecialchars($_POST['isbn_col']));
$isbnSep = htmlspecialchars($_POST['isbn_sep']);


if (empty($_POST["input"])) {

    $cols2compare = explode(",", htmlspecialchars($_POST['compare_cols']));
    $compare_info = explode(",", htmlspecialchars($_POST['compare_info']));

    $time = date("Y-m-d") . "_" . time();
    $inputName = "tmp/" . 'compareInfo-input_' . $time . '.csv';
    $outputName = "tmp/" . 'compareInfo-output-clean_' . $time . '.csv';
    $output_badName = "tmp/" . 'compareInfo-output-bad_' . $time . '.csv';
    $output_allName = "tmp/" . 'compareInfo-output-all_' . $time . '.csv';

    $input = file($_FILES['data']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='post'>\n";

    foreach ($input as $line) {

        $inputTable = explode($inputSep, $line);

        $isbns = explode($isbnSep, $inputTable[$colISBN - 1]);

        $compare = '';
        foreach ($cols2compare as $col) {

            if (substr_count(trim($col), "InputCol"))
                $compare = $compare . ";" . $inputTable[intval(ltrim(trim($col), "InputCol_")) - 1];

        }
        $compare = ltrim($compare, ";");

        $colorIsbn = "<font color='blue'>" . $inputTable[$colISBN - 1] . "</font>";

        echo " ---- " . $compare . "<br>\n";

        foreach ($isbns as $isbn) {

            $checked = '';

            $amazonInfo = amazonInfo($isbn, $public_key, $private_key);
            $amazonError = $amazonInfo['error'];


            if ($amazonError != '')
                $colorIsbn = "<font color='red'>" . $isbn . "</font>";
            else
                $colorIsbn = "<font color='green'>" . $isbn . "</font>";


            $outLine = '';
            foreach ($compare_info as $item) {

                if (in_array($amazonInfo[trim($item)], $inputTable) or in_array(strtolower($amazonInfo[trim
                    ($item)]), $inputTable)) {
                    $outLine = $outLine . ";<font color='green'>" . $amazonInfo[trim($item)] .
                        "</font>";
                    $checked = 'checked';
                } else
                    $outLine = $outLine . ";<font color='blue'>" . $amazonInfo[trim($item)] .
                        "</font>";

            }
            $outLine = ltrim($outLine, ";") . "\n";


            echo "<input type='checkbox' name='" . rtrim($inputTable[0], ".html") . $isbn .
                "' " . $checked . "/> - " . $outLine . " - " . $colorIsbn . "<br>\n";
        }

        echo "<hr>\n";

        flush();
    }

    move_uploaded_file($_FILES['data']['tmp_name'], $inputName);

    echo "<input type='hidden' name='input' value='" . $inputName . "' />
        <input type='hidden' name='output' value='" . $outputName . "' />
        <input type='hidden' name='output_bad' value='" . $output_badName . "' />
        <input type='hidden' name='output_all' value='" . $output_allName . "' />
        <input type='hidden' name='col_sep' value='" . $_POST['col_sep'] . "' />
        <input type='hidden' name='col_sep_other' value='" . $_POST['col_sep_other'] . "' />
        <input type='hidden' name='isbn_col' value='" . $_POST['isbn_col'] . "' />
        <input type='hidden' name='isbn_sep' value='" . $_POST['isbn_sep'] . "' />
        <input type='submit' value='Next' /></form>";

} else {

    $input = file($_POST["input"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $output = fopen($_POST["output"], "w");
    $output_bad = fopen($_POST["output_bad"], "w");
    $output_all = fopen($_POST["output_all"], "w");

    foreach ($input as $line) {

        $inputTable = explode($inputSep, $line);

        $isbns = explode($isbnSep, $inputTable[$colISBN - 1]);


        $newIsbns = '';
        foreach ($isbns as $isbn) {

            if ($_POST[rtrim($inputTable[0], ".html") . $isbn])
                $newIsbns = $newIsbns . "," . $isbn;
        }
        $newIsbns = ltrim($newIsbns, ",");

        fwrite($output_all, $inputTable[0] . "\t" . $newIsbns . "\n");
        if ($newIsbns != '')
            fwrite($output, $inputTable[0] . "\t" . $newIsbns . "\n");
        else
            fwrite($output_bad, $inputTable[0] . "\n");


    }


    echo "Done!<br>";
    echo "<a href=" . $_POST["output"] . ">output-clean</a><br>";
    echo "<a href=" . $_POST["output_bad"] . ">output-bad</a><br>";
    echo "<a href=" . $_POST["output_all"] . ">output-all</a><br>";


}

?>
  
  
  
</body>
</html>
