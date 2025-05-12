<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";
session_start();
$mode = $_POST['mode'];
$rating = $_POST['rating'];
$movie_id = $_POST['movie_id'];
$user_id = $_POST['user_id'];
$comment = $_POST['comment'];

$model = new Users();

function lexicon($comment, $user_id, $movie_id){
        $model = new Users();
        $negative = array();
        $positive = array();
        $total = 0;
        $negCount = 0;
        $posCount = 0;
        $posPercent = 0;
        $sentiment = "";
        $negFile = fopen("../../assets/negative-words.txt", "r") or die("Unable to open neg!");
        $posFile = fopen("../../assets/positive-words.txt", "r") or die("Unable to open pos!");

        while (!feof($negFile)) {
            $line = trim(fgets($negFile));
            if (!empty($line)) {
                $negative[] = strtolower($line); 
            }
        }
    
        while (!feof($posFile)) {
            $line = trim(fgets($posFile));
            if (!empty($line)) {
                $positive[] = strtolower($line); 
            }
        }

        $arraySentiment = explode(" ", $comment);
        foreach($arraySentiment as $word){
            $word = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $word));

            if(in_array($word, $negative)){
                $sentiment = "Negative";
                $negCount++;
                $total++;
            } else if(in_array($word, $positive)){
                $sentiment = "Positive";
                $posCount++;
                $total++;
            }

            if(in_array($word, $negative) || in_array($word, $positive)){
                if(!$model->checkExistingWord($word)){
                    $model->addWord($word, $sentiment);
                } 

                $review_id = $model->getReviewID($user_id, $movie_id);
                $word_id = $model->getWordID($word);
                if(!$model->checkExistingReviewWord($review_id, $word_id)){
                    $model->addReviewWord($review_id, $word_id);
                } else {
                    $model->updateReviewWord($word_id, $review_id);
                }
                
            }
        }


        if($total == 0){
            $posPercent = 0; 
        } else if($posCount == $negCount){
            $posPercent = 0.5;
        } else {
            $posPercent = $posCount / $total;
        }
          
        fclose($negFile);
        fclose($posFile);

        return $posPercent;
}


if($mode == 0){
    $model->addUserReview($rating, $movie_id, $user_id, $comment);
    $_SESSION['existing_review'] = '1';
    $score = lexicon($comment, $user_id, $movie_id);
    $model->updateReviewScore($user_id, $movie_id, $score);
    echo "Successfully Added";
} else if($mode == 1){
    $model->updateExisting($user_id, $movie_id, $comment, $rating);
    $review_id =$model->getReviewID($user_id, $movie_id);
    $model->deleteReviewWord($review_id);
    $score = lexicon($comment, $user_id, $movie_id);
    $model->updateReviewScore($user_id, $movie_id, $score);
    echo "Successfully Updated";
} else {
    $model->deleteExisting($user_id, $movie_id);
    $review_id =$model->getReviewID($user_id, $movie_id);
    $model->deleteReviewWord($review_id);
    $_SESSION['existing_review'] = '0';
    echo "Successfully Deleted";
}

?>