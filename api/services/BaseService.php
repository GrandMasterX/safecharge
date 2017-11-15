<?php

namespace grandmasterx\safecharge\api\services;

use grandmasterx\safecharge\api\RestClient;
use grandmasterx\safecharge\api\interfaces\ServiceInterface;

/**
 * Class BaseService
 * @package grandmasterx\safecharge\api\services
 */
class BaseService implements ServiceInterface
{

    /**
     * @var RestClient
     */
    protected $_client;

    /**
     * @var string
     */
    protected $_apiUrl;

    /**
     * @var
     */
    protected $_errors;

    /**
     * BaseService constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        $this->_client = $client;
        $this->_apiUrl = $this->_client->getApiUrl();
    }

    /**
     * @return RestClient
     */
    public function getClient() {
        return $this->_client;
    }

    /**
     * Check if merchantId, merchantSiteId and timeStamp parameters are given.
     * If they are not, we get them from the configuration and append them
     * @param $params
     * @return mixed
     */
    public function appendMerchantIdMerchantSiteIdTimeStamp($params) {
        if (empty($params['merchantId'])) {
            $params['merchantId'] = $this->_client->getConfig()->getMerchantId();
        }
        if (empty($params['merchantSiteId'])) {
            $params['merchantSiteId'] = $this->_client->getConfig()->getMerchantSiteId();
        }
        if (empty($params['timeStamp'])) {
            $params['timeStamp'] = date('YmdHms');
        }
        return $params;
    }

    /**
     * @param $params
     * @param $mandatoryFields
     * @return bool
     * @throws \Exception
     */
    public function validate($params, $mandatoryFields) {
        $missingFields = false;
        $arrayKeys = array_keys($params);
        foreach ($mandatoryFields as $field) {
            if (!in_array($field, $arrayKeys)) {
                $missingFields[] = $field;
            }
        }
        if (!empty($missingFields)) {
            throw new \Exception('Missing input parameters: ' . implode(',', $missingFields));
        }
        return true;
    }

    /**
     * @param $params
     * @param $endpoint
     * @return mixed
     */
    public function requestJson($params, $endpoint) {
        $curlClient = $this->_client->getHttpClient();
        return $curlClient->requestJson($this, $this->_apiUrl . $endpoint, $params);
    }

    /**
     * @param $params
     * @param $endpoint
     * @return mixed
     */
    public function requestPost($params, $endpoint) {
        $curlClient = $this->_client->getHttpClient();
        return $curlClient->requestPost($this, $this->_apiUrl . $endpoint, $params);
    }
}
