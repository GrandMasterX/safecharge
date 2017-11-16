<?php

namespace grandmasterx\safecharge\api\payments;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;
use grandmasterx\safecharge\api\services\BaseService;

/**
 * Class Payout
 * @package grandmasterx\safecharge\api\payments
 */
class Payout extends BaseService
{

    /**
     * Refund constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function payout(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'clientUniqueId',
            'amount',
            'currency',
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
        return $this->requestJson($params, 'payout.do');
    }
}
