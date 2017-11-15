<?php

namespace grandmasterx\safecharge\api\services;

use grandmasterx\safecharge\api\Utils;
use grandmasterx\safecharge\api\RestClient;

/**
 * Class UserPaymentOptions
 * @package grandmasterx\safecharge\api\services
 */
class UserPaymentOptions extends BaseService
{

    /**
     * UserPaymentOptions constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        parent::__construct($client);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function addUPOCreditCard(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'ccCardNumber',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'ccCardNumber',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'billingAddress',
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
        return $this->requestJson($params, 'addUPOCreditCard.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function addUPOCreditCardByToken(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
//            'ccCardNumber',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'ccToken',
            'brand',
            'uniqueCC',
            'bin',
            'last4Digits',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'ccToken',
            'brand',
            'uniqueCC',
            'bin',
            'last4Digits',
            'billingAddress',
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
        return $this->requestJson($params, 'addUPOCreditCardByToken.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function addUPOCreditCardByTempToken(array $params) {
        $mandatoryFields = [
            'sessionToken',
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'ccTempToken',
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
        return $this->requestJson($params, 'addUPOCreditCardByTempToken.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function addUPOAPM(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'paymentMethodName',
            'apmData',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'paymentMethodName',
            'apmData',
            'billingAddress',
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
        return $this->requestJson($params, 'addUPOAPM.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function editUPOCC(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPaymentOptionId',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'userPaymentOptionId',
            'ccExpMonth',
            'ccExpYear',
            'ccNameOnCard',
            'billingAddress',
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
        return $this->requestJson($params, 'editUPOCC.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function editUPOAPM(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPaymentOptionId',
            'apmData',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'userPaymentOptionId',
            'apmData',
            'billingAddress',
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
        return $this->requestJson($params, 'editUPOAPM.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function deleteUPO(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPaymentOptionId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'userPaymentOptionId',
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
        return $this->requestJson($params, 'deleteUPO.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getUserUPOs(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
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
                $params,
                $checksumParametersOrder,
                $this->_client->getConfig()->getMerchantSecretKey(),
                $this->_client->getConfig()->getHashAlgorithm()
            );
        }
        $this->validate($params, $mandatoryFields);
        return $this->requestJson($params, 'getUserUPOs.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function suspendUPO(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPaymentOptionId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'userPaymentOptionId',
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
        return $this->requestJson($params, 'suspendUPO.do');
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function enableUPO(array $params) {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPaymentOptionId',
            'timeStamp',
            'checksum'
        ];
        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'clientRequestId',
            'userPaymentOptionId',
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
        return $this->requestJson($params, 'enableUPO.do');
    }
}
