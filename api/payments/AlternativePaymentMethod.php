<?php

namespace grandmasterx\safecharge\api\payments;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;
use grandmasterx\safecharge\api\services\BaseService;

/**
 * Class AlternativePaymentMethod
 * @package grandmasterx\safecharge\api\payments
 */
class AlternativePaymentMethod extends BaseService
{

    /**
     * AlternativePaymentMethod constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getMerchantPaymentMethods(array $params) {
        $mandatoryFields = [
            'sessionToken',
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
        return $this->requestJson($params, 'getMerchantPaymentMethods.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function paymentAPM(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'merchantId',
            'merchantSiteId',
            'currency',
            'amount',
            'paymentMethod',
            'urlDetails',
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
        return $this->requestJson($params, 'paymentAPM.do');
    }
}
