<?php

class kolchar {
  private $name;
  private $filename;
  private $num;
  
  public function __construct ( $filename, $dir ) {
    $this->filename = $filename;
    if ( ereg( "^(.+)_\(#([0-9]{1,8})\).htm", $filename, $char ) ) {
      $this->name = $char[1];
      $this->num = $char[2];
    }
    else if ( ereg ( "([0-9]{1,8}).htm", $filename ) ){
      $pwd = getcwd();
      $file =  "$pwd/$dir/$filename";
      if (is_readable( $file )) {
	$fd = fopen( "$pwd/$dir/$filename", "r");
	$contents = fread ( $fd, filesize($file) );
	if ( ereg ( "<b>(.+)</b></td>.+\(#([0-9]{1,8})\)", $contents, $char ) ){
	  $this->name = $char[1];
	  $this->num = $char[2];
	} else if ( ereg( "color=white>([a-zA-z0-9_ ]+)<?", $contents, $char ) ) {
	  $this->name = $char[1];
	  ereg( "who=([0-9]{1,8})",$contents, $char );
	  $this->num = $char[1];
	}
	fclose( $fd );
      }
    }
  }

  public function get_name() {
    return $this->name;
  }

  public function get_num() {
    return $this->num;
  }
  public function get_filename() {
    return $this->filename;
  }

  public function getdb() {
    return "http://koldb.com/player.php?name=" . $this->num;
  }
  
  public function get_collect() {
    return "http://www.jickenwings.org/collections/index.cgi?query_type=player&query_value=" . $this->num;
  }
  }
  ?>