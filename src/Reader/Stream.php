<?php 
namespace Foobar\Reader;
use Foobar\Parser\Capture;

class Stream
{
  function __construct() {
    $this->parser = new Capture();
    $this->stream_object = [];
    //var_dump($this->parser);
  }
  
  function parse ($query) {
    $this->stream_object['input'] = $this->parser->parse($query);
  }
  
  function read($query) {
    self::parse($query);
    return self::display();
  }

  function display () {
    return $this->stream_object['input'];
  }
}

?>