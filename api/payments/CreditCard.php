<?php

namespace grandmasterx\safecharge\api\payments;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;
use grandmasterx\safecharge\api\services\BaseService;

/**
 * Class CreditCard
 * @package grandmasterx\safecharge\api\payments
 */
class CreditCard extends BaseService
{

    /**
     * CreditCard constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function cardTokenization(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'cardData'
        ];
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'cardTokenization.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function paymentCC(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'merchantId',
            'merchantSiteId',
            'transactionType',
            'isRebilling',
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
        return $this->requestJson($params, 'paymentCC.do');
    }
}
