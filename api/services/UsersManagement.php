<?php

namespace grandmasterx\safecharge\api\services;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;

/**
 * Class UsersManagement
 * @package grandmasterx\safecharge\api\services
 */
class UsersManagement extends BaseService
{

    /**
     * UsersManagement constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createUser(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'countryCode',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'firstName',
            'lastName',
            'address',
            'state',
            'city',
            'zip',
            'countryCode',
            'phone',
            'locale',
            'email',
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
        return $this->requestJson($params, 'createUser.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUser(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'firstName',
            'lastName',
            'address',
            'state',
            'city',
            'zip',
            'countryCode',
            'phone',
            'locale',
            'email',
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
        return $this->requestJson($params, 'updateUser.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getUserDetails(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'timeStamp',
            'merchantSecretKey'
        ];
        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);
        if (empty($params['checksum'])) {
            $params['checksum'] = Utils::calculateChecksum(
                $params, $checksumParametersOrder,
                $this->_client->getConfig()->getMerchantSecretKey(),
                $this->_client->getConfig()->getHashAlgorithm()
            );
        }
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'getUserDetails.do');
    }
}
