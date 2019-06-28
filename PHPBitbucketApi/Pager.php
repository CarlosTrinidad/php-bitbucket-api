<?php
  namespace PHPBitbucketApi;
/**
 * Pager for requests
 */
class Pager
{
    protected $url;
    protected $options;
    protected $result = null;
    protected $next = null;
    protected $prev = null;

    public function __construct($url, $opt)
    {
        $this->url = $url;
        $this->options = $this->httpBuilder($opt);
    }

    public function httpBuilder($options)
    {
        $credentials = base64_encode(CLIENT_ID.':'.APP_PASSWORD);
        $http = array('header' => "", 'method' => "", 'content' => "" );
        $header[] = "Authorization: Basic {$credentials}";
        $header[] = "Host: bitbucket.org";
        $header[] = "Connection: close";
        $header[] = "Accept: application/json";
        if ($options['method'] === 'POST') {
          $header[] = "Content-type: application/x-www-form-urlencoded; charset=utf-8";
          $http['content'] = http_build_query($options['params']);
        }
        $http['method'] = $options['method'];
        $http['header'] = $header;
        return array('http' => $http);
    }

    public function fetch($cache = false)
    {
      if ($cache === true && $this->result !== null) {
        return $this->result;
      }
      $context  = stream_context_create($this->options);
      $result = file_get_contents($this->url, false, $context);
      if ($result === false) {
        exit;
      }
      $this->result = json_decode($result, true);
      $this->next = null;
      $this->prev = null;
      if (!empty($this->result['next'])) {
        $this->next = $this->result['next'];
      }
      if (!empty($this->result['previous'])) {
        $this->prev = $this->result['previous'];
      }
      return $this->result;
    }

    public function next()
    {
      if ($this->next === null) {
        return null;
      }
      $context  = stream_context_create($this->options);
      $result = file_get_contents($this->next, false, $context);
      if ($result === false) {
        exit;
      }
      $this->result = json_decode($result, true);
      $this->next = null;
      $this->prev = null;
      if (!empty($this->result['next'])) {
        $this->next = $this->result['next'];
      }
      if (!empty($this->result['previous'])) {
        $this->prev = $this->result['previous'];
      }
      return $this->result;
    }
    public function prev()
    {
      if ($this->prev === null) {
        return null;
      }
      $context  = stream_context_create($this->options);
      $result = file_get_contents($this->prev, false, $context);
      if ($result === false) {
        exit;
      }
      $this->result = json_decode($result, true);
      $this->next = null;
      $this->prev = null;
      if (!empty($this->result['next'])) {
        $this->next = $this->result['next'];
      }
      if (!empty($this->result['previous'])) {
        $this->prev = $this->result['previous'];
      }
      return $this->result;
    }
}
