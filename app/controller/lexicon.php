<?php
$sentiment = "The phone is superb but the battery is .";
$negative = array();
$positive = array();
$total = 0;
$negCount = 0;
$posCount = 0;
$posPercent = 0;
$negFile = fopen("../../assets/negative-words.txt", "r") or die("Unable to open neg!");
$posFile = fopen("../../assets/positive-words.txt", "r") or die("Unable to open pos!");

while(!feof($negFile)) {
  $negative[] = trim(fgets($negFile));
}

while(!feof($posFile)) {
  $positive[] = trim(fgets($posFile));
}

$arraySentiment = explode(" ", $sentiment);
foreach($arraySentiment as $word){
  $word = preg_replace('/[^A-Za-z0-9\-]/', '', $word);

  if(in_array($word, $negative)){
    $negCount++;
    $total++;
  } else if(in_array($word, $positive)){
    $posCount++;
    $total++;
  }
}


if($posCount == $negCount){
    $posPercent = 0.5;
} else {
    $posPercent = $posCount/$total;
}

if($posPercent == 0.5){
  echo "Oks lang";
} else if($posPercent > 0.5){
  echo "Good Shit";
} else {
  echo "Shit";
}

fclose($negFile);
fclose($posFile);
?>