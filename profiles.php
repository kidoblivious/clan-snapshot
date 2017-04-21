<html>
<head>
<?php require_once 'header.inc'; ?>
</head>
<body>
<?php
require_once 'kolchar.inc';

$dir = $_GET[ 'dir' ];

if (ereg ( "20[0-9]{2}[0,1]{1}[0-9]{1}_w[0-9]", $dir ) ) {
  $target = opendir ( $dir . "/profiles/" );
  if ( readdir($target) ) {
    rewinddir($target);
    echo "<table border=1> <tr> <td> <b> Name </b> </td><td> <b> Jicken Wings Link </b> </td> </tr>\n";
    $data = array();
    while ($file = readdir ($target) ) {
      if ($file != "." && $file != "..") {
	$char = new kolchar( $file, $dir . "/profiles" );
	$data[ $char->get_num() ] = $char;
      }
    }
    sort($data);
    foreach ( $data as $char ) {
      $anchor = "<a href=\"$dir/profiles/" . urlencode($char->get_filename()) . "\"> ". $char->get_name() . " </a>";
      $dbanchor = "<a href=\"" . $char->get_collect() . "\">" . $char->get_num() . "</a>";
      echo "<tr> <td> $anchor </td> <td align=\"right\"> $dbanchor </td> </tr> \n";  
    }
    echo "</table>";
  }
}  else echo "No records seem to exist here.";


?>
</body>
</html>






