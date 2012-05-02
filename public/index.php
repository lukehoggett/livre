<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Epub reader sandbox</title>
		
<!--		<link rel="stylesheet" type="text/css" href="/css/reset.css"/>-->
		<link rel="stylesheet" type="text/css" href="/css/style.css"/>
		
	</head>
	<body>

<?php
	$logDir = '../private/logs';
	ini_set('display_errors', 1);
//	ini_set('log_errors', 1);
//	ini_set('error_log', $logDir . '/error_log.txt');
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
	$epubMimeType = 'application/epub+zip';
	$mimeFile = 'mimetype';
	if (!is_file($mimeFile)) {
		exit('mimefile missing!!');
	}
	
	if (file_get_contents($mimeFile) != $epubMimeType) {
		exit('could not reliably determine the mimetype of this file');
	}
	
	// get the location of the contents file from the container file
	if (!is_dir('META-INF')) {
		exit('No META-INF directory found');
	}
	
	$containerXml = new SimpleXMLElement('META-INF/container.xml', 0, true);
	
	$tocLocation = $containerXml->rootfiles->rootfile['full-path'];
	
	
	// open the content file
	$contentXml = new SimpleXMLElement($tocLocation, 0, true);
	
	// display the meta data from the file
	$metadata = $contentXml->metadata->meta;
	foreach ($metadata as $key => $data) {
//		echo sprintf("%s: %s \n", $data['name'], $data['content']);
	}
	
	// get the spine data
	$spine = $contentXml->spine;
	// @todo check for a ADE toc
	
	// get the manifest data
	$manifest = $contentXml->manifest;
	$toc = array();
	// @todo refactor to actually use the simple xml element methods
	foreach ($spine->itemref as $key => $itemref) {
		foreach ($manifest->item as $item) {
			if ((string) $item['id'] == (string) $itemref['idref']) {
				$toc[] = $item;
				break;
			}
		}
	}
	$html = '';
	foreach ($toc as $content) {
		if (strpos($content['href'], 'xhtml') === false) {
			$chapterContent = file_get_contents($content['href']);
			var_dump($content);
			// @todo need to be able to filter out the header content, e.g. meta title css etc
			$html .=<<<html
<div class="chapter-content">{$chapterContent}</div>
html;
		}
	}
?>
		<div id="content">
			<?php echo $html;?>
		</div>
		<form>
			<fieldset>
				<label for="upload">upload epub</label>
				<input type="file" name="upload" id="upload" />
				<input type="submit" name="submit" id="submit" value="upload" />
			</fieldset>	
		</form>
	</body>
	
</html>