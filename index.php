<html>
<head>
<?php require_once 'header.inc'; ?>

</head>
<body>
<h1>
The <?php print $clan ?> Clan Snapshots
</h1>

<table border=2>
<?php
function prettify( $ugly ) {
  $week = "week " . $ugly[strlen($ugly)-1];
  $month = $ugly[4] . $ugly[5];
  $bgcolor = array();
  $bgcolour[red] = 0;
  $bgcolour[green] = 256;
  $bgcolour[blue] = 0;
  $bgcolour[green] = $bgcolour[green] - ($month * 11) ;
  $bgcolour[blue] = $bgcolour[blue] + ($month * 21) ;
  $months = array( 1 => "January", "February", "March", "April",
		   "May", "June", "July", "August",
		   "September", "October", "November", "December");
  $month =  $months[(int)($month)];

  $year = $ugly[3] + 2000;
  
  $pretty = "<td bgcolor=" . sprintf('"#%02X%02X%02X"', $bgcolour[red], $bgcolour[green], $bgcolour[blue]) . ">$month $year $week </td>";
  return $pretty;
}

$dirs = scandir(".", 1 );
$relevant_dirs = array();

$i = 0;
foreach ($dirs as $dir) {
  if (is_dir($dir) && $dir[0] != ".") {
    $relevant_dirs[$i++] = $dir;
  }
}
rsort ($relevant_dirs, SORT_STRING);

foreach ($relevant_dirs as $dir ) {
  $pretty_dir = prettify( $dir );
  $anchor = '<a href="' . $dir;
  $hardcore = 'Hardcore';
  $softcore = 'Softcore';
  $breakdown = 'Breakdown';
  $profiles = 'Profiles';
  $ascensions = 'Ascensions';
  if (file_exists( $dir.'/hardcore.htm' )) {
    $hardcore = $anchor . '/hardcore.htm"> Hardcore </a>';
  }
  if (file_exists($dir.'/softcore.htm')) {
    $softcore = $anchor . '/softcore.htm"> Softcore </a>';
  }
  if (file_exists( $dir.'/standard.htm')) {
    $breakdown = $anchor . '/standard.htm"> Breakdown </a>'; 
  } 
  $pro_dir = opendir( "$dir/profiles" );
  $no_profiles = 0;
  while ($file = readdir($pro_dir) ) {
    if ($file[0] != "." ) { 
      $no_profiles++;
    }
  }
  closedir($pro_dir);
  $profiles = '<a href="profiles.php?dir=' . $dir .'"> Profiles ' . "($no_profiles)" . '</a>';
  $ascensions = '<a href="ascensions.php?dir=' . $dir . '"> Ascensions </a>';
  print( "<tr align=\"center\">  $pretty_dir <td> $hardcore </td> <td> $softcore </td> <td> $breakdown </td> <td> $profiles </td> <td> $ascensions</td> </tr>\n");
}

?>
</table>

</body>
<!-- php hand crafted by Dicky/Gleamglade, 20/08/08 -->
</html>
