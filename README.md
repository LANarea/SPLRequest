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
- Set Port for TCP connections to Station Playlist Studio
- Set path of files that are requestable
- Possibly: Forward the previously mentioned port so it's reachable from your public IP.
(To be continued.)


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