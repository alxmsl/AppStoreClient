<?php

namespace alxmsl\AppStore;
use Network\Http\Request;

/**
 * Abstract AppStore client class
 * @author alxmsl
 * @date 2/14/13
 */ 
abstract class AbstractClient {
    /**
     * @var string shared secret password
     */
    private $password = '';

    /**
     * @var bool use sandbox endpoints
     */
    private $sandbox = false;

    /**
     * @var int connect timeout, seconds
     */
    private $connectTimeout = 0;

    /**
     * @var int request timeout, seconds
     */
    private $requestTimeout = 0;

    /**
     * Getter for the request
     * @param string $url request url
     * @return Request request object
     */
    protected function getRequest($url) {
        $Request = new Request();
        $Request->setTransport(Request::TRANSPORT_CURL);
        return $Request->setUrl($url)
            ->setConnectTimeout($this->getConnectTimeout())
            ->setTimeout($this->getRequestTimeout())
            ->setContentTypeCode(Request::CONTENT_TYPE_JSON);
    }

    /**
     * Setter for shared secret password
     * @param string $clientSecret shared secret password
     * @return AbstractClient self
     */
    public function setPassword($clientSecret) {
        $this->password = (string) $clientSecret;
        return $this;
    }

    /**
     * Getter for shared secret password
     * @return string shared secret password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Setter for use sandbox endpoints
     * @param bool $sandbox use sandbox endpoint or not
     * @return AbstractClient self
     */
    public function setSandbox($sandbox) {
        $this->sandbox = (bool) $sandbox;
        return $this;
    }

    /**
     * Getter for use sandbox endpoints
     * @return bool use sandbox endpoint or not
     */
    public function isSandbox() {
        return $this->sandbox;
    }

    /**
     * Setter for connect timeout value
     * @param int $connectTimeout connect timeout, seconds
     * @return AbstractClient self
     */
    public function setConnectTimeout($connectTimeout) {
        $this->connectTimeout = (int) $connectTimeout;
        return $this;
    }

    /**
     * Getter for connect timeout value
     * @return int connect timeout, seconds
     */
    public function getConnectTimeout() {
        return $this->connectTimeout;
    }

    /**
     * Setter for request timeout value
     * @param int $requestTimeout request timeout, seconds
     * @return AbstractClient self
     */
    public function setRequestTimeout($requestTimeout) {
        $this->requestTimeout = (int) $requestTimeout;
        return $this;
    }

    /**
     * Getter for request timeout value
     * @return int request timeout, seconds
     */
    public function getRequestTimeout() {
        return $this->requestTimeout;
    }
}
