[SPLRequest](https://github.com/LANarea/SPLRequest)
================================

[![Join the chat at https://gitter.im/LANarea/SPLRequest](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/LANarea/SPLRequest?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

SPLRequest is a very small PHP library which makes it able to connect
with StationPlaylist Studio, loading all available songs in the library
and even do live song requests to the server.
 
You can obtain the latest version from our [GitHub repository](https://github.com/LANarea/SPLRequest)
or install it via Composer:

	composer require lanarea/splrequest

or manually add it to composer.json:

```
{
    "require": {
        "lanarea/splrequest": "dev-master"
    }
}
```

	
Preparation
-----------
	
Some (local) settings need to be applied before you can use this script:

* Open StationPlaylist Studio,
* Open the Options window (Ctrl+O or View > Options)

* Enable the connection with SPL from the outside:
	* On the left, select the tab named "Communications",
	* Set the port for TCP connections to StationPlaylist Studio
	* You don't need to set the "Send Response" value, as far as I know
	* Optionally, but preferably, set an IP Restriction (to the same IP as where the script is running)
	* Possibly: Forward the previously mentioned port so it's reachable from your public IP. This option can be found in your Router's settings or via your ISP

* Set which directories to make public:
	* On the left, select the tab named "Folder Locations"
	* The input box next to the "Search Folders" label contains the folders where this script can cruise through
	* Don't forget to enable the checkbox for "Include subfolders"


Usage
-----

Autoload or include the class, and enable the namespace to make use of the class:
```
use LANarea\SPLRequest;
```

---

Make a new SPLRequest object and include the IP-address/Hostname, and the TCP port:
```
$spl = new SPLRequest('0.0.0.0', 0);
```

---

Get all available songs via this operator:

```
$results = $spl->getAllSongs(); // returns an array of all songs
```
The above is equal to the following:
```
$results = $spl->search('*');
```
Might be subject to the "Max Search Results"-setting under the "Communications" tab.

---

Searching for a song:
- Use * as a wildcard operator (eg. "Avril*" for all songs starting with 'Avril')
- Use | as an end to the query (eg. "A*|" for a list of all songs starting with an A)
```
$results = $spl->search('Avril Lavigne*'); // returns an array, or false
```
Tip: Surround all your queries with the wildcard operator, eg. "\*Elvis\*"

---

Do a song request:
```
$spl->doRequest('C:/path/to/music - file.mp3'); // returns true or false
```
Alternatively you can add even more useful information!
```
$spl->doRequest('C:/path/to/music - file.mp3', 'John Doe', 'Brussels, Belgium');
```

---

Alternatively, you could check out the example.php file.

Note
-----

You have to implement your own request limits, caching and such.

With this package, you can only handle the data we can get to and from SPL.

Known issues
------------

* Special signs like é,ä,û; are rendered as questionmarks. Probably something with the encoding.


License
-------
It is licensed under the New BSD License.