<?php 
namespace Foobar\Parser;

class Capture
{
  function __construct() {
    $this->stream = [
      'query' => null,
      'length' => 0,
      'groups' => [],
    ];

    $this->group_selector = [
      'start' => '(',
      'end' => ')',
    ];

    $this->operators = [
      '+',
    ];
  }
  
  private function readLine (string $str, $index) {
    $__strlen = strlen($str);
    $this->stream['groups'][$index] = [];

    $__str ='';
    for($x = 0; $x < $__strlen; $x++) {
      # append each character
      $__str.= $str[$x];
      if($str[$x] === $this->group_selector['end']) {
        $this->stream['groups'][$index][] = $__str;
      }
    }
  }
  
  private function cluster() { 
    foreach($this->stream['groups'] as $key => $val) {
      $__strlen = strlen($val);
      for($x = 0; $x < $__strlen; $x++) {
        if($val[$x] === $this->group_selector['start']) self::readline(substr($val, $x), $key);
      }
      
    } 
 
  }

  private function group() {
    foreach($this->operators as $val) {
      # convert   ((foo)*bar*(bar*foo) + (bar*foo)) + (foo*bar) 
      # to        ((foo)*bar*(bar*foo)   (bar*foo))   (foo*bar) 
      $__separator = " {$val} "; 
      $__parsed = (explode($__separator, $this->stream['query']));
      $this->stream['groups'] = $__parsed;
      # cluster
      self::cluster();
      
    }

  }

  function parse($query) {
    # load stream info
    $this->stream['query'] = $query;
    $this->stream['length'] = strlen($this->stream['query']);
    # group
    self::group();
  
  }
  

}

?>