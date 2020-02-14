<?php
$unsortedFile = fopen("unsorted-names-list.txt", "r");
$sortedFile = fopen("sorted-names-list.txt", "w");

function arrayFromFile($file){
	$ret = array();
	while (!feof($file)){ 
		$currentLine = fgets($file);
		$currentLineDeleteNewLine = str_replace(array("\r", "\n"), '', $currentLine);
		array_push($ret, $currentLineDeleteNewLine);
	}
	fclose($file);
	return $ret;
}
function sortFromBackword($data = array()){
	$datas = $data;
	$jumlah = count($data);
	$lastWords = array();

	for ($i=0; $i < $jumlah ; $i++) {
		$words = explode(" ", $data[$i]);
		$indexLastWord = (count($words) - 1);
		$lastWord = $words[$indexLastWord];
		array_push($lastWords, $lastWord);
	}

	for ($i=0; $i < $jumlah; $i++) {
		for ($j= ($i + 1); $j < $jumlah ; $j++) { 
			if ($lastWords[$i] > $lastWords[$j]) {

				$tmpLastWord = $lastWords[$i];
				$lastWords[$i] = $lastWords[$j];
				$lastWords[$j] = $tmpLastWord;

	            $tempDatas = $datas[$i];
	            $datas[$i] = $datas[$j];
	            $datas[$j] = $tempDatas;

			}
			if ($lastWords[$i] == $lastWords[$j]) {

				$wordsOne = explode(" ", $datas[$i]);
				$indexPrevWordOne = (count($wordsOne) - 2);
				$secondWordOne = $wordsOne[$indexPrevWordOne];

				$wordsTwo = explode(" ", $datas[$j]);
				$indexPrevWordTwo = (count($wordsTwo) - 2);
				$secondWordTwo = $wordsTwo[$indexPrevWordTwo];

				if ($secondWordOne > $secondWordTwo) {
					$tmpLastWord = $lastWords[$i];
					$lastWords[$i] = $lastWords[$j];
					$lastWords[$j] = $tmpLastWord;

		            $tempDatas = $datas[$i];
		            $datas[$i] = $datas[$j];
		            $datas[$j] = $tempDatas;					
				}

			}
		}
	}
	return $datas;
}
function writeDataSorted($file,$data = array()){
	for ($i=0; $i <count($data); $i++) { 
		fwrite($file, $data[$i]."\n");
	}
	fclose($file);
}

$arrayFromFile = arrayFromFile($sortedFile);
$sortFromBackword = sortFromBackword($arrayFromFile);
writeDataSorted($sortedFile,);


?>