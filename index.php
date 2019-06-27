<?php

//
// $comm = RepoCommits('DocumentTest');
// // var_dump($comm);
// // var_dump($comm['values'][0]['date']);
// // //
// // $datetime = strtotime($comm['values'][1]['date']);
// // var_dump(date('Y-m-d H:i:s', $datetime));
//
// CommitsToDate($comm['values']);
//
//
// function RepoCommits($repo='', $url = "")
// {
//     $credentials = base64_encode(CLIENT_ID.':'.APP_PASSWORD);
//     if (empty($url)) {
//         $url = "https://api.bitbucket.org/2.0/repositories/ctrinidad16/DocumentTest/commits/master?pagelen=7";
//     }
//
//     $options = array(
//       'http' => array(
//           'header'  => "Authorization:Basic {$credentials}\r\n".
//                        "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n".
//                        "Host: bitbucket.org\r\n".
//                        "Connection: close\r\n",
//           'method'  => 'GET',
//       )
//   );
//     return request($url, $options);
// }
//
// function request($url = '', $options = [])
// {
//     $context  = stream_context_create($options);
//     $result = file_get_contents($url, false, $context);
//     if ($result === false) {
//         exit;
//     }
//     return json_decode($result, true);
// }
//
// function CommitsToDate($commits=[], $date = "2017-01-01")
// {
//     foreach ($commits as $key => $commit) {
//         // $dateCommit = date('Y-m-d', strtotime($commit['date']));
//         // if ($dateCommit <= $date) {
//         //     exit;
//         // }
//         //
//         if ($key == count($commits) - 1) {
//             $arrayName1 = array('date' => 1, );
//             $arrayName2 = array('date' => 2, );
//             $arrayName3 = array('date' => 4, );
//             $commits = array_merge($commits, [$arrayName1,  $arrayName2,  $arrayName3]);
//             var_dump($commits);
//         }
//         var_dump($key);
//         var_dump($commit['date']);
//     }
// }


include_once('Repositories.php');


$repo = new Repositories(CLIENT_ID, 'DocumentTest');

$repoCommits = $repo->commits("", array('pagelen' => 1 ));

var_dump($repoCommits->fetch());
echo "NEXT";
var_dump($repoCommits->next());
echo "NEXT";
var_dump($repoCommits->next());
echo "previous";
var_dump($repoCommits->prev());
