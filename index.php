<?php


include_once('PHPBitbucketApi/Repositories.php');

$repo = new PHPBitbucketApi\Repositories(CLIENT_ID, 'DocumentTest');

$repoCommits = $repo->commits("", array('pagelen' => 1 ));

// var_dump($repoCommits->fetch());
// echo "NEXT";
// var_dump($repoCommits->next());
// echo "NEXT";
// var_dump($repoCommits->next());
// echo "previous";
// var_dump($repoCommits->prev());

var_dump(commitsRecursive($repoCommits, '2018-09-13', '2018-09-13'));

function commitsRecursive($commits, $date1, $date2){
  $commitsInRange = [];
  $result = $commits->fetch(true);
  foreach ($result['values'] as $commit) {
    $dateCommit = date( 'Y-m-d', strtotime($commit['date']) );
    $dateCommit = new DateTime($dateCommit);
    $newDate1 = new DateTime($date1);
    $newDate2 = new DateTime($date2);
    if ($dateCommit >= $newDate1 && $dateCommit <= $newDate2) {
      $commitsInRange[]=$commit;
    }
  }
  if ($commits->next() === null) {
    return $commitsInRange;
  }
  $commitsInRange = array_merge($commitsInRange,commitsRecursive($commits, $date1, $date2));
  return $commitsInRange;
}
