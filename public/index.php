<?php
echo '<pre>';
	$logDir = '../private/logs';
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', $logDir . '/error_log.txt');
	error_reporting(E_ALL);
	
	
	include_once '../private/libs/epub/EPub.php';
	include_once '../private/libs/zip/Zip.php';
	
	
	
	// extract an epub to a dir
	$booksBasePath = '../private/books'; 
	$bookname= '/Dan Abnett - First & Only.epub';
	$epub =  new ZipArchive();
	$filename = $booksBasePath . $bookname;
	if ($epub->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
		exit("cannot open <$bookname>\n");
	}
	$extractBasePath = $booksBasePath;
	$extractDirName = $extractBasePath . str_replace(array(' '), array('-'), $bookname);
	if (!is_dir($extractDirName)) {
		mkdir($extractDirName);
	}
	$epub->extractTo($extractDirName);
	
	// check the mimetype file, and the toc
	chdir($extractDirName);
	var_dump(getcwd());
	$epubMimeType = 'application/epub+zip';
	$mimeFile = 'mimetype';
	if (!is_file($mimeFile)) {
		exit('mimefile missing!!');
	}
	
	if (file_get_contents($mimeFile) != $epubMimeType) {
		exit('could not reliably determine the mimetype of this file');
	}
	
	var_dump(file_get_contents($mimeFile));
	
echo '</pre>';

exit('fin!');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Epub reader sandbox</title>
	</head>
	<body>
		
		
		<form>
			<fieldset>
				<label for="upload">upload epub</label>
				<input type="file" name="upload" id="upload" />
				<input type="submit" name="submit" id="submit" value="upload" />
			</fieldset>	
		</form>
	</body>
	
</html>