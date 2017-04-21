
Default Clan snapshot webserver scripts.

Here are some little scripts I wrote to beautify the clan snapshots directory.
They won't work unless you are serving it up on a (Apache) web server with 
php this however isn't a tutorial on installing them (I must emphasize this 
is no big shakes if you are considering about it.)

What it does

* Colours each record depending on month of the year 
* Provides handy access to the internal directories mafia makes for the snapshots 
  through the other scripts. (Tested for usefulness to red/green colourblind 
  people on Mister Flopsy, feedback gratefully received.)
* ascensions.php gives the saved ascensions for your clannies and their 
  links to the KoLDB.
* profiles.php gives the saved profiles of the clannies and links for each
  of them to the jicken wings DC database.
* kolchar.inc collects the small bits of common code together in a useful place.

	For your server:
	Extract into the directory you copy clan snapshots into on your webserver.
	Change the value in header.inc from
		$clan = "Something Lounge"; to
		$clan = "Clam of Doom";
	Point browser at directory.
	Cake!