<?php
/**
 * CheddarGetter
 * @category CheddarGetter
 * @package CheddarGetter
 * @author Marc Guyer <marc@cheddargetter.com>
 */
/**
 * Adapter implementation based on php-curl for requesting the CheddarGetter service
 * @category CheddarGetter
 * @package CheddarGetter
 * @author Marc Guyer <marc@cheddargetter.com>
 * @author Christophe Coevoet <stof@notk.org>
 * @example example/example.php
 */

class CheddarGetter_Client_CurlAdapter implements CheddarGetter_Client_AdapterInterface {

	/**
	 * The curl resource
	 *
	 * @var resource|null
	 */
	protected $_resource;

	/**
	 * Constructor
	 * @param resource $resource
	 * @throws CheddarGetter_Client_Exception Throws an exception if php-curl is not available.
	 */
	public function __construct($resource = null) {
		if (!function_exists('curl_init')) {
			throw new CheddarGetter_Client_Exception('The curl extension is not loaded.', CheddarGetter_Client_Exception::USAGE_INVALID);
		}

		if ($resource && (!is_resource($resource) || get_resource_type($resource) != 'curl')) {
			throw new CheddarGetter_Client_Exception('The curl resource is invalid.', CheddarGetter_Client_Exception::USAGE_INVALID);
		}

    if (!$resource) {
      $resource = curl_init();
      $userAgent = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] . ' - CheddarGetter_Client PHP' : 'CheddarGetter_Client PHP';
      $options = array(
        CURLOPT_RETURNTRANSFER => true, // gimme the results
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => $userAgent,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_MAXREDIRS => 0
      );
      foreach ($options as $key=>$val) {
        curl_setopt($resource, $key, $val);
      }
    }

		$this->_resource = $resource;
	}

	/**
	 * Execute CheddarGetter API request
	 *
	 * @param string $url Url to the API action
	 * @param string $username Username
	 * @param string $password Password
	 * @param array|null $args HTTP post key value pairs
	 * @return string Body of the response from the CheddarGetter API
	 * @throws CheddarGetter_Client_Exception Throws an exception if the curl session results in an error.
	 */
	public function request($url, $username, $password, array $args = null) {
		curl_setopt($this->_resource, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($this->_resource, CURLOPT_HTTPGET, true);
		curl_setopt($this->_resource, CURLOPT_URL, $url);

		if ($args) {
			curl_setopt($this->_resource, CURLOPT_POST, true);
			curl_setopt($this->_resource, CURLOPT_POSTFIELDS, http_build_query($args, null, '&'));
		}

		$result = curl_exec($this->_resource);

		if ($result === false || curl_error($this->_resource) != '') {
			throw new CheddarGetter_Client_Exception('cUrl session resulted in an error: (' . curl_errno($this->_resource) . ')' . curl_error($this->_resource), CheddarGetter_Client_Exception::UNKNOWN);
		}

		return $result;

	}

	/**
	 * Get the curl resource if set
	 * @return null|resource
	 */
	public function getCurlResource() {
		return $this->_resource;
	}
}
