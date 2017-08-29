<!DOCTYPE html>

<html lang="en">

  <head>
    <?php require_once 'header.inc'; ?>
  </head>

  <body>
    <?php
      require_once 'kolchar.inc';

      $dir = $_GET[ 'dir' ];

      if (ereg ( "20[0-9]{2}[0,1]{1}[0-9]{1}_w[0-9]", $dir ) ) {
        $target = opendir ( $dir . "/ascensions/" );
        if ( readdir($target) ) {
          rewinddir($target);

          echo "<table border=1> <tr> <td> <b> Name </b> </td><td> <b> KoLDB Link </b> </td> </tr>";

          $data = array();
          while ($file = readdir ($target) ) {
            if ($file != "." && $file != "..") {
            	$char = new kolchar( $file, $dir . "/ascensions" );
            	$data[ $char->get_num() ] = $char;
            }
          }
          sort($data);
          foreach ( $data as $char ) {
            $anchor = "<a href=\"$dir/ascensions/" . urlencode($char->get_filename()) . "\"> ". $char->get_name() . " </a>";
            $dbanchor = "<a href=\"" . $char->getdb() . "\">" . $char->get_num() . "</a>";

            echo "<tr> <td> $anchor </td> <td> <center> $dbanchor </center> </td> </tr> \n";

          }
          echo "</table>";
        }
        closedir($target);
      } else echo "No records seem to exist here.";
    ?>
  </body>
  
</html>