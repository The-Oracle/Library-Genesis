<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <title>InfoLoad</title>
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

$load_info = explode($isbnSep, htmlspecialchars($_POST['load_info']));

$input = file($_FILES['data']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$time = date("Y-m-d") . "_" . time();
$inputName = "tmp/" . 'batchload-input_' . $time . '.csv';
$foundName = "tmp/" . 'batchload-found_' . $time . '.csv';
$output_allName = "tmp/" . 'batchload-output-all_' . $time . '.csv';
$notfoundName = "tmp/" . 'batchload-notfound_' . $time . '.csv';

$found = fopen($foundName, "w");
$notfound = fopen($notfoundName, "w");
$output_all = fopen($output_allName, "w");


foreach ($input as $line) {

    $isbn_found = false;

    $inputTable = explode($inputSep, $line);

    $isbns = explode($isbnSep, $inputTable[$colISBN - 1]);
    $colorIsbn = "<font color='blue'>" . $inputTable[$colISBN - 1] . "</font>";

    foreach ($isbns as $isbn) {

        $amazonInfo = amazonInfo($isbn, $public_key, $private_key);
        $amazonError = $amazonInfo['error'];
        if ($amazonError == '') {

            $isbn_found = true;

            $title4echo = htmlspecialchars($amazonInfo['Title'], ENT_QUOTES);
            $colorIsbn = str_replace($isbn, "<font color='green'>" . $isbn . "</font>", $colorIsbn);

            break;

        } else {

            $title4echo = "<font color='red'>not found</font>";
            $colorIsbn = str_replace($isbn, "<font color='red'>" . $isbn . "</font>", $colorIsbn);


        }

    }


    //output
    $outLine = '';
    foreach ($load_info as $item) {

        if (substr_count($item, "InputCol"))
            $outLine = $outLine . "\t" . $inputTable[intval(ltrim($item, "InputCol_")) - 1];
        else
            $outLine = $outLine . "\t" . $amazonInfo[$item];

    }
    $outLine = ltrim($outLine) . "\n";


    fwrite($output_all, $outLine);

    if ($isbn_found)
        fwrite($found, $outLine);
    else
        fwrite($notfound, $line . "\n");

    echo $colorIsbn . " - " . $title4echo . "<br>\n";
    flush();
}
move_uploaded_file($_FILES['data']['tmp_name'], $inputName);

echo "<a href=" . $foundName . ">found</a><br>";
echo "<a href=" . $notfoundName . ">notfound</a><br>";
echo "<a href=" . $output_allName . ">output-all</a><br>";

?>
  
  
  
</body>
</html>
