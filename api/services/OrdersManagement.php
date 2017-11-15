<?php

namespace grandmasterx\safecharge\api\services;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;

/**
 * Class OrdersManagement
 * @package grandmasterx\safecharge\api\services
 */
class OrdersManagement extends BaseService
{

    /**
     * Authentication constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function openOrder(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'merchantId',
            'merchantSiteId',
            'currency',
            'amount',
            'items',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'clientRequestId',
            'amount',
            'currency',
            'timeStamp',
            'merchantSecretKey'
        ];
        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);
        if (empty($params['checksum'])) {
            $params['checksum'] = Utils::calculateChecksum(
                $params,
                $checksumParametersOrder,
                $this->_client->getConfig()->getMerchantSecretKey(),
                $this->_client->getConfig()->getHashAlgorithm()
            );
        }
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'openOrder.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateOrder(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'orderId',
            'merchantId',
            'merchantSiteId',
            'currency',
            'amount',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'clientRequestId',
            'amount',
            'currency',
            'timeStamp',
            'merchantSecretKey'
        ];
        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);
        if (empty($params['checksum'])) {
            $params['checksum'] = Utils::calculateChecksum(
                $params,
                $checksumParametersOrder,
                $this->_client->getConfig()->getMerchantSecretKey(),
                $this->_client->getConfig()->getHashAlgorithm()
            );
        }
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'updateOrder.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getOrderDetails(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'orderId',
            'merchantId',
            'merchantSiteId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'clientRequestId',
            'timeStamp',
            'merchantSecretKey'
        ];
        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);
        if (empty($params['checksum'])) {
            $params['checksum'] = Utils::calculateChecksum(
                $params,
                $checksumParametersOrder,
                $this->_client->getConfig()->getMerchantSecretKey(),
                $this->_client->getConfig()->getHashAlgorithm()
            );
        }
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'getOrderDetails.do');
    }
}
