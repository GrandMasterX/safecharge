<?php

namespace grandmasterx\safecharge\api;

use Exception;
use grandmasterx\safecharge\api\interfaces\ConfigInterface;

/**
 * Class Config
 * @package grandmasterx\safecharge\api
 */
class Config implements ConfigInterface
{

    /**
     *
     */
    const ENDPOINT_LIVE = "https://secure.safecharge.com/ppp/api";

    /**
     *
     */
    const ENDPOINT_TEST = "https://ppp-test.safecharge.com/ppp/api";

    /**
     * @var array
     */
    protected $configData = [];

    /**
     * @var array
     */
    protected $allowedHashAlgorithms = [
        'sha256',
        'md5'
    ];

    /**
     * @var array
     */
    protected $allowedOutput = [
        'array',
        'json'
    ];

    /**
     * @var string
     */
    protected $defaultOutput = 'array';

    /**
     * Config constructor.
     * @param bool $params
     */
    public function __construct($params = false) {
        if ($params && is_array($params)) {
            foreach ($params as $key => $param) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    call_user_func([
                        $this,
                        $methodName
                    ], $param);
                } else {
                    $this->configData[$key] = $param;
                }
            }
        }
        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key) {
        return isset($this->configData[$key]) ? $this->configData[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value) {
        $this->configData[$key] = $value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setOutputType($value) {
        $this->set('outputType', $value);
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getOutputType() {
        if (isset($this->configData['outputType'])
            && in_array($this->configData['outputType'], $this->allowedOutput)
        ) {
            return $this->configData['outputType'];
        }
        return $this->defaultOutput;
    }

    /**
     * @param $environment
     * @return $this
     * @throws Exception
     */
    public function setEnvironment($environment) {
        if ($environment == Environment::TEST) {
            $this->set('environment', Environment::TEST);
            $this->set('endpoint', self::ENDPOINT_TEST);
        } elseif ($environment == Environment::LIVE) {
            $this->set('environment', Environment::LIVE);
            $this->set('endpoint', self::ENDPOINT_LIVE);
        } else {
            $msg = "This environment does not exists use " . Environment::TEST . ' or ' . Environment::LIVE;
            throw new Exception($msg);
        }
        return $this;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getEnvironment() {
        if (!isset($this->configData['environment'])) {
            throw new Exception('environment is not configured');
        }
        return $this->configData['environment'];
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getEndpoint() {
        if (!isset($this->configData['environment'])) {
            throw new Exception('environment is not configured');
        }
        if (!isset($this->configData['endpoint'])) {
            throw new Exception('endpoint is not configured');
        }
        return $this->configData['endpoint'];
    }

    /**
     * @param $merchantSiteId
     * @return $this
     */
    public function setMerchantSiteId($merchantSiteId) {
        $this->set('merchantSiteId', $merchantSiteId);
        return $this;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getMerchantSiteId() {
        if (!isset($this->configData['merchantSiteId'])) {
            throw new Exception('merchantSiteId is not configured');
        }
        return $this->configData['merchantSiteId'];
    }

    /**
     * @param $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId) {
        $this->set('merchantId', $merchantId);
        return $this;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getMerchantId() {
        if (!isset($this->configData['merchantId'])) {
            throw new Exception('merchantId is not configured');
        }
        return $this->configData['merchantId'];
    }

    /**
     * @param $merchantSecretKey
     * @return $this
     */
    public function setMerchantSecretKey($merchantSecretKey) {
        $this->set('merchantSecretKey', $merchantSecretKey);
        return $this;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getMerchantSecretKey() {
        if (!isset($this->configData['merchantSecretKey'])) {
            throw new Exception('merchantSecretKey is not configured');
        }
        return $this->configData['merchantSecretKey'];
    }

    /**
     * @param $hashAlgorithm
     * @return $this
     * @throws Exception
     */
    public function setHashAlgorithm($hashAlgorithm) {
        if (!in_array($hashAlgorithm, $this->allowedHashAlgorithms)) {
            throw new Exception(
                'hashAlgorithm '
                . $hashAlgorithm
                . ' is not supported. Please use '
                . implode(', ', $this->allowedHashAlgorithms) . ' .'
            );
        }
        $this->set('hashAlgorithm', $hashAlgorithm);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHashAlgorithm() {
        if (!isset($this->configData['hashAlgorithm'])) {
            $this->setHashAlgorithm('sha256');
        }
        return $this->configData['hashAlgorithm'];
    }
}
