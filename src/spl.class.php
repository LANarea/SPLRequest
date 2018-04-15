<?php

namespace LANarea;

/**
 * Studio Playlist Request Class.
 *
 * @author Ken Verhaegen <contact@kenverhaegen.be>
 * @copyright 2014 LANarea
 * @license BSD-3-Clause
 *
 * @version 1.0
 */
class SPLRequest
{
    /**
     * Server IP/Hostname.
     *
     * @var string
     */
    private $server_ip = null;
    /**
     * Server port.
     *
     * @var int
     */
    private $server_port = null;

    /**
     * Initialize the class and save the server credentials.
     *
     * @param string $server_ip
     * @param int    $server_port
     */
    public function __construct($server_ip, $server_port)
    {
        $this->setIp($server_ip);
        $this->setPort($server_port);
    }

    /**
     * Get all the songs at once.
     *
     * @return array
     */
    public function getAllSongs()
    {
        return $this->search('*'); // Simple, huh?
    }

    /**
     * Search for songs.
     *
     * Use '*' as a wildcard
     * Use '|' as an endline at the end
     *
     * @param string $query   The value we need to search for
     * @param bool   $process Wether or not to internally process the output
     *
     * @return array
     */
    public function search($query, $process = true)
    {
        $pure_output = $this->doQuery('Search='.$query, 'Not Found');

        return ($process === true) ? $this->processSongs($pure_output) : $pure_output;
    }

    /**
     * Process the songs to have a nicer output of data.
     *
     * @param  array|string
     *
     * @return array|string
     */
    private function processSongs($songs)
    {
        if (!is_array($songs)) {
            return $songs;
        }

        $newList = [];

        for ($i = 0; $i < count($songs); $i++) {
            if (empty($songs[$i])) {
                continue;
            }
            list($artist, $title, $filepath) = explode('|', $songs[$i]);
            $newList[] = [
                'artist'   => trim($artist),
                'title'    => trim($title),
                'filepath' => trim($filepath),
            ];
        }

        return $newList;
    }

    /**
     * Get a list of the requests in the waitinglist.
     *
     * @param bool $process Wether or not to internally process the output
     *
     * @return array
     */
    public function getRequests($process = true)
    {
        $pure_output = $this->doQuery('List requests', 'OK');

        return ($process === true) ? $this->processRequests($pure_output) : $pure_output;
    }

    /**
     * Process the requests to have a nicer output of data.
     *
     * @param array $requests
     *
     * @return array
     */
    private function processRequests($requests)
    {
        $newList = [];

        for ($i = 0; $i < count($requests); $i++) {
            if (empty($requests[$i])) {
                continue;
            }
            list($timestamp_and_name, $artist, $title) = explode('|', $requests[$i]);
            list($timestamp, $name) = explode('  ', $timestamp_and_name);
            $datetime = \DateTime::createFromFormat('d/m/Y H:i', $timestamp);
            $newList[] = [
                'timestamp' => $datetime->format('Y-m-d H:i'),
                'name'      => trim($name),
                'artist'    => trim($artist),
                'title'     => trim($title),
            ];
        }

        return $newList;
    }

    /**
     * Do the song request to the server and optionally send along the name and/or location.
     *
     * @param string $filepath Filepath where the song is located on the local drive
     * @param string $name     Requester's name
     * @param string $location Requester's current location
     *
     * @return bool Wheter or not the request has succeeded
     */
    public function doRequest($filepath = null, $name = '', $location = '')
    {
        if (is_null($filepath)) {
            return false;
        }

        $command = 'Insert Request='.$filepath.'|'.$_SERVER['REMOTE_ADDR'];
        if ($name || $location) {
            $command .= '|'.$name.'|'.$location;
        }

        return ($this->doQuery($command) == 'Thank you! Your request has been submitted.') ? true : false;
    }

    /**
     * Set the IP of the server.
     *
     * @param string $server_ip The IP-addres/host where we connect to
     */
    public function setIp($server_ip)
    {
        $this->server_ip = $server_ip;

        return true;
    }

    /**
     * Set the port of the server.
     *
     * @param int $server_port The port where we connect to
     */
    public function setPort($server_port)
    {
        $server_port = intval($server_port);
        if (is_int($server_port)) {
            $this->server_port = $server_port;

            return true;
        }

        return false;
    }

    /**
     * doQuery sends the commands and reads the output going to and coming from SPL.
     *
     * @param string      $command The command we send to SPL
     * @param bool|string $multi   Do we expect multiple output lines from server, can be the "stop-word" as value
     *
     * @return string|array|bool Returns false when failed
     */
    public function doQuery($command = null, $multi = false)
    {
        if (!is_null($command) && !empty($command)) {
            $data = [];
            $command = rawurldecode($command);
            if (get_magic_quotes_gpc()) {
                $command = stripslashes($command);
            }
            $command .= "\r\n"; // Adding the vital NewLine to the given command
            $fp = fsockopen($this->server_ip, intval($this->server_port), $errno, $errstr, 10);
            if ($fp !== false) {
                fwrite($fp, $command);
                $buffer = trim(fgets($fp));
                if ($multi === true || is_string($multi)) {
                    $stopmsg = is_string($multi) ? $multi : 'OK';
                    while (!empty($buffer) && ($buffer != $stopmsg)) {
                        $data[] = $buffer;
                        $buffer = trim(fgets($fp));
                    }
                } else {
                    $data = $buffer;
                }
                fclose($fp);
            } else {
                throw new SPLRequestException('SPLRequest Error\r\n'.$errno.': '.$errstr.'\r\n');
            }
        } else {
            throw new SPLRequestException('No valid command given.');
        }

        return !empty($data) ? $data : false;
    }
}

/**
 * An exception generated by SPLRequest.
 */
class SPLRequestException extends \Exception
{
}
