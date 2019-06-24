<?php


var_dump(RepoCommits('DocumentTest'));


function RepoCommits($repo='')
{
  $credentials = base64_encode(CLIENT_ID.':'.APP_PASSWORD);

  $url = "https://api.bitbucket.org/2.0/repositories/ctrinidad16/DocumentTest/commits/master?q=%28state+%3D+%22new%22+OR+state+%3D+%22on+hold%22%29+AND+assignee+%3D+null+AND+component+%3D+%22UI%22+and+date+%3E+2020-11-11T00%3A00%3A00-07%3A00";

  $options = array(
      'http' => array(
          'header'  => "Authorization:Basic {$credentials}\r\n".
                       "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n".
                       "Host: bitbucket.org\r\n".
                       "Connection: close\r\n",
          'method'  => 'GET',
      )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) {
  exit;
  }
  return json_decode($result, true);
}
