<?php

namespace grandmasterx\safecharge\api\payments;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;
use grandmasterx\safecharge\api\services\BaseService;

/**
 * Class Settle
 * @package grandmasterx\safecharge\api\payments
 */
class Settle extends BaseService
{

    /**
     * Settle constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function settleTransaction(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'currency',
            'amount',
            'relatedTransactionId',
            'authCode',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'clientRequestId',
            'clientUniqueId',
            'amount',
            'currency',
            'relatedTransactionId',
            'authCode',
            'descriptorMerchantName',
            'descriptorMerchantPhone',
            'comment',
            'urlDetails',
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
        return $this->requestJson($params, 'settleTransaction.do');
    }
}
