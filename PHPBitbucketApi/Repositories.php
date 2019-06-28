<?php
namespace PHPBitbucketApi;
include_once('Pager.php');

use PHPBitbucketApi\Pager;

// $page = new Pager();
//
// var_dump($page);

/**
 * Collection of repos
 */
class Repositories
{
  protected $username;
  protected $repo_slug;

  public function __construct($username = "", $repo_slug = "")
  {
    $this->username = $username;
    $this->repo_slug = $repo_slug;
  }

  public function commits($revision = "", $query=[], $params=[])
  {

    // $query -> get
    $stringQuery = "";
    if (!empty($query)) {
      $stringQuery = "?".http_build_query($query);
    }
    $url = "https://api.bitbucket.org/2.0/repositories/{$this->username}/{$this->repo_slug }/commits/{$revision}{$stringQuery}";
    // $params -> body
    $options = array('method' => 'GET', 'params' => $params);
    $page = new Pager($url, $options);
    return $page;
  }
}
