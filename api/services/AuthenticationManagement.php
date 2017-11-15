<?php

namespace grandmasterx\safecharge\api\services;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;

/**
 * Class AuthenticationManagement
 * @package grandmasterx\safecharge\api\services
 */
class AuthenticationManagement extends BaseService
{

    /**
     * AuthenticationManagement constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getSessionToken(array $params = []) {
        $mandatoryFields = [
            'merchantId',
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
        return $this->requestJson($params, 'getSessionToken.do');
    }
}
