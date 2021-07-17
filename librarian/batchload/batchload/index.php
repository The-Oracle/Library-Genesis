<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<title>BatchLoad</title></head>
<body>

<div align="center"><h2>Сопоставление информации по ISBN</h2></div>

<form action="compareInfo.php" method="post" enctype="multipart/form-data">

<h3><u>Формат входного файла</u></h3>
<font color='blue'>Разделитель колонок : </font> 
<input type="radio" name="col_sep" value="tab" checked="checked"/> Tab
<input type="radio" name="col_sep" value="space" /> Space
<input type="radio" name="col_sep" value="semicolon" /> Semicolon
<input type="radio" name="col_sep" value="other" /> Other 
<input type="text" name="col_sep_other" value="" size="2" maxlength="3"/>

<br />

<font color='blue'>Номер ISBN-колонки : </font> 
<input type="text" name="isbn_col" value="2" size="2" maxlength="2"/> 
<font color='blue'>Разделитель отдельных ISBN : </font>
<input type="text" name="isbn_sep" value="," size="2" maxlength="3"/><br /><br />

<font color='blue'>Колонки для сопоставления : </font>
<input type="text" name="compare_cols" value="InputCol_3,InputCol_4" size="50" maxlength="100"/>
<br />
<br />
<font color='blue'>Файл : </font> 
<input type="file" name="data" size="80" />
<br />

<h3><u>Выбор доступной информации</u> (amazon)</h3>
<font color='blue'>Допустимые поля:</font> <font color='gray'>Title,Author,Year,Publisher,Edition,Pages,ISBN,Language,Content,Image</font><br />
<input type="text" name="compare_info" value="Title,Author" size="100" maxlength="100"/>
<br />
<br />
<div align="center"><input type="submit" value="Сопоставить" /></div>
</form>

<hr />

<div align="center"><h2>Пакетная загрузка информации по ISBN</h2></div>

<form action="batchload.php" method="post" enctype="multipart/form-data">

<h3><u>Формат входного файла</u></h3>
<font color='blue'>Разделитель колонок : </font> 
<input type="radio" name="col_sep" value="tab" checked="checked"/> Tab
<input type="radio" name="col_sep" value="space" /> Space
<input type="radio" name="col_sep" value="semicolon" /> Semicolon
<input type="radio" name="col_sep" value="other" /> Other 
<input type="text" name="col_sep_other" value="" size="2" maxlength="3"/>

<br />


<font color='blue'>Номер ISBN-колонки : </font> 
<input type="text" name="isbn_col" value="2" size="2" maxlength="2"/>  
<font color='blue'>Разделитель отдельных ISBN : </font>
<input type="text" name="isbn_sep" value="," size="2" maxlength="3"/><br /><br />

<font color='blue'>Файл : </font><input type="file" name="data" size="80" /><br /><br />

<h3><u>Выбор доступной информации</u> (amazon)</h3>
<font color='blue'>Допустимые поля:</font> <font color='gray'>Title,Author,Year,Publisher,Edition,Pages,ISBN,Language,Content,Image</font><br />
<font color='blue'>и колонки входного файла: </font> <font color='gray'>InputCol_1, InputCol_2</font> <font color='blue'> и.т.д.</font><br />
<input type="text" name="load_info" value="InputCol_1,Title,Author,Year,Publisher,Edition,Pages,ISBN,Language,Content,Image" size="100" maxlength="100"/>

<br />
<br />

<div align="center"><input type="submit" value="Начать поиск" /></div>
</form>

</body></html>
