<?php

namespace grandmasterx\safecharge\api\interfaces;

/**
 * Interface ConfigInterface
 * @package grandmasterx\safecharge\api\interfaces
 */
interface ConfigInterface
{

    /**
     * ConfigInterface constructor.
     * @param bool $params
     * @return $this
     */
    public function __construct($params = false);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * @param $value
     * @return $this
     */
    public function setOutputType($value);

    /**
     * @return mixed
     */
    public function getOutputType();

    /**
     * @param $environment
     * @return $this
     */
    public function setEnvironment($environment);

    /**
     * @return mixed
     */
    public function getEnvironment();

    /**
     * @return mixed
     */
    public function getEndpoint();

    /**
     * @param $merchantSiteId
     * @return $this
     */
    public function setMerchantSiteId($merchantSiteId);

    /**
     * @return mixed
     */
    public function getMerchantSiteId();

    /**
     * @param $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId);

    /**
     * @return mixed
     */
    public function getMerchantId();

    /**
     * @param $merchantSecretKey
     * @return $this
     */
    public function setMerchantSecretKey($merchantSecretKey);

    /**
     * @return mixed
     */
    public function getMerchantSecretKey();

    /**
     * @param $hashAlgorithm
     * @return $this
     */
    public function setHashAlgorithm($hashAlgorithm);

    /**
     * @return mixed
     */
    public function getHashAlgorithm();
}
