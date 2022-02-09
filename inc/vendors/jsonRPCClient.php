<?php
/*
					COPYRIGHT

Copyright 2007 Sergio Vaccaro <sergio@inservibile.org>

This file is part of JSON-RPC PHP.

JSON-RPC PHP is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

JSON-RPC PHP is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with JSON-RPC PHP; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * The object of this class are generic jsonRPC 1.0 clients
 * http://json-rpc.org/wiki/specification
 *
 * @author sergio <jsonrpcphp@inservibile.org>
 */
class jsonRPCClient {

	const DEBUG_REQUEST = 0x1;
	const DEBUG_RESPONSE = 0x2;

	/**
	 * Debug state
	 * Bitwise combination of debug flags (DEBUG_REQUEST, DEBUG_RESPONSE)
	 *
	 * @var boolean
	 */
	protected $debug = 0;

	/**
	 * The server URL
	 *
	 * @var string
	 */
	protected $url = null;
	/**
	 * The request id
	 *
	 * @var integer
	 */
	protected static $id = 0;
	/**
	 * If true, notifications are performed instead of requests
	 *
	 * @var boolean
	 */
	protected $notification = false;
	/**
	 *
	 * @var string
	 */
	protected $proxy = '';
	/**
	 *
	 * @var array
	 */
	protected $headers = array();

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url
	 * @param boolean $debug
	 * @param string $proxy
	 */
	public function __construct($url, $debug = false, $proxy = '') {
		// server URL
		$this->url = $url;
		// debug state
		$this->debug = $debug ? self::DEBUG_REQUEST | self::DEBUG_RESPONSE : 0;
		// proxy
		$this->proxy = $proxy;
		$this->restoreDefaultHeaders();
	}

	/**
	 * 
	 * @param string $type
	 * @param string $value
	 */
	public function setHeader($type, $value) {
		$this->headers[$type] = $value;
	}

	/**
	 * Remove single header from request
	 * @param string $type
	 */
	public function removeHeader($type) {
		unset($this->headers[$type]);
	}

	/**
	 * Restore default header 
	 */
	public function restoreDefaultHeaders() {
		$this->headers = array();
		$this->headers['Content-type'] = 'application/json';
	}

	/**
	 * Set debug state
	 * @param int $debug bitwise combination of debug flags
	 */
	public function setDebug($debug) {
		$this->debug = (int) $debug;
	}

	/**
	 * Set proxy to be used in connection
	 * @param string $proxy
	 */
	public function setProxy($proxy) {
		$this->proxy = $proxy;
	}

	/**
	 * Sets the notification state of the object. In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function setRPCNotification($notification) {
		$this->notification = (bool) $notification;
	}

	/**
	 *
	 * @param int $debug bitwise combination of debug flags
	 * @param string $message
	 */
	protected function debugLog($debug, $message) {
		if ($this->debug & $debug) {
			echo $message . PHP_EOL . PHP_EOL;
		}
	}

	/**
	 * Performs a jsonRCP request and gets the results as an array
	 *
	 * @param string $method
	 * @param array $params
	 * @return array|boolean
	 * @throws Exception
	 */
	public function __call($method, $params) {

		++static::$id;

		// check
		if (!is_scalar($method)) {
			throw new Exception('Method name has no scalar value');
		}

		// check
		if (is_array($params)) {
			// no keys
			$params = array_values($params);
		} else {
			throw new Exception('Params must be given as array');
		}

		// sets notification or request task
		if ($this->notification) {
			$currentId = NULL;
		} else {
			$currentId = static::$id;
		}

		$request_data = array(
			'method' => $method,
			'params' => $params,
			'id' => $currentId
		);
		
		if ($this->proxy) {
			$request_data['proxy'] = $this->proxy;
		}

		// prepares the request
		$request = json_encode($request_data);
		$this->debugLog(self::DEBUG_REQUEST, '***** Request *****' . PHP_EOL . $request . PHP_EOL . '***** End Of request *****');

		$this->headers['Content-Length'] = strlen($request);
		$headers = array();
		foreach($this->headers as $key => $value) {
			$headers[] = $key . ': ' . $value;
		}

		// performs the HTTP POST
		$opts = array ('http' => array (
							'method'  => 'POST',
							'header'  => implode("\r\n", $headers),
							'content' => $request
							));

		$context  = stream_context_create($opts);

		$this->headers = array();

		$fp = fopen($this->url, 'r', false, $context) or die("Error connecting to Dogecoin node! Try again later!");

		if (!$fp) {
			throw new Exception('Unable to connect to node!');
		}

		$response = '';
		while (!feof($fp)) {
			$response .= trim(fgets($fp)) . "\n";
		}
		fclose($fp);

		$this->debugLog(self::DEBUG_RESPONSE, '***** Server response *****' . PHP_EOL . $response . '***** End of server response *****');

		// final checks and return
		if (!$this->notification) {
			$response = json_decode($response, true);

			// check
			if ($response['id'] != $currentId) {
				throw new Exception('Incorrect response id (request id: ' . $currentId . ', response id: ' . $response['id'] . ')');
			}
			if (!is_null($response['error'])) {
				throw new Exception('Request error: ' . $response['error']);
			}

			return $response['result'];
		}
		unset($response);

		return true;
	}

}
