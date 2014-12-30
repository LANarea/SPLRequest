[SPLRequest](https://github.com/LANarea/SPLRequest)
================================

SPLRequest is a very small PHP library which makes it able to connect
with Station Playlist Studio, loading all available songs in the library
and even do live song requests to the server.
 
You can obtain the latest version from our [GitHub repository](https://github.com/LANarea/SPLRequest)
or install it via Composer:

	composer require LANarea/SPLRequest
	
	
Preparation
-----------
	
Some (local) settings need to be applied before you can use this script:

First we need the options pane.
- Open StudioPlaylist Studio,
- Open the Options window (Ctrl+O or View > Options)

1. Enable the connection with SPL from the outside:
- On the left, select the tab named "Communications",
- Set the port for TCP connections to Station Playlist Studio
- You don't need to set the "Send Response" value, as far as I know
- Optionally, but preferably, set an IP Restriction (to the same IP as where the script is running)
- Possibly: Forward the previously mentioned port so it's reachable from your public IP. This option can be found in your Router's settings or via your ISP

2. Set which directories to make public:
- On the left, select the tab named "Folder Locations"
- The input box next to the "Search Folders" label contains the folders where this script can cruise through
- Don't forget to enable the checkbox for "Include subfolders"


Usage
-----

(To be continued.)

Note
-----

You have to implement your own request limits, caching and such.
With this package, we can only serve the data we can get to and from SPL.


License
-------
It is licensed under the New BSD License.