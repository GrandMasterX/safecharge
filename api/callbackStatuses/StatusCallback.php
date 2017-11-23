<?php

namespace grandmasterx\safecharge\api\callbackStatuses;

/**
 * Class StatusCallback
 * @package Omnipay\Safecharge\Message
 */
class StatusCallback
{

    /**
     *
     */
    const STATUS_SUCCESSFUL = 'approved';

    /**
     *
     */
    const STATUS_DECLINED = 'declined';

    /**
     *
     */
    const STATUS_ERROR = 'error';

    /**
     *
     */
    const STATUS_PENDING = 'pending';

    /**
     * @var array
     */
    public $data;

    /**
     * StatusCallback constructor.
     * @param array $post
     */
    public function __construct(array $post) {
        $this->data = $post;
    }

    /**
     * @return bool
     */
    public function isSuccessful() {
        return (mb_strtolower($this->getStatus()) == self::STATUS_SUCCESSFUL ? true : false);
    }

    /**
     * @return bool
     */
    public function isDeclined() {
        return (mb_strtolower($this->getStatus()) == self::STATUS_DECLINED ? true : false);
    }

    /**
     * @return bool
     */
    public function isError() {
        return (mb_strtolower($this->getStatus()) == self::STATUS_ERROR ? true : false);
    }

    /**
     * @return bool
     */
    public function isPending() {
        return (mb_strtolower($this->getStatus()) == self::STATUS_PENDING ? true : false);
    }

    /**
     * @return mixed
     */
    public function getCode() {
        return $this->getStatus();
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->data['Status'];
    }

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->data['totalAmount'];
    }

    /**
     * @return mixed
     */
    public function getCurrency() {
        return $this->data['currency'];
    }

    /**
     * @return mixed
     */
    public function getTimestamp() {
        return $this->data['responseTimeStamp'];
    }

    /**
     * @return mixed
     */
    public function getTransactionId() {
        return $this->data['PPP_TransactionID'];
    }

    /**
     * @return mixed
     */
    public function getProductId() {
        return $this->data['productId'];
    }

    /**
     * @return mixed
     */
    public function getResponseChecksum() {
        return $this->data['advanceResponseChecksum'];
    }

    /**
     * @return mixed
     */
    public function getCardMask() {
        return $this->data['cardNumber'];
    }

    /**
     * @return mixed
     */
    public function getCardHolder() {
        return $this->data['nameOnCard'];
    }

    /**
     * @return mixed
     */
    public function getReason() {
        return $this->data['Reason'];
    }

    /**
     * @return mixed|string
     */
    public function getMessage() {
        return (isset($this->data['message']) ? $this->data['message'] : '');
    }

    /**
     * @param $secret_word
     * @param string $hashing_algo
     * @return string
     */
    public function CalculateChecksum($secret_word, $hashing_algo = 'md5') {
        $available = [
            'md5',
            'sha256'
        ];
        $concat = $secret_word . $this->getAmount() . $this->getCurrency() . $this->getTimestamp() . $this->getTransactionId() . $this->getStatus() . $this->getProductId();
        if (in_array($hashing_algo, $available)) {
            $signature = hash($hashing_algo, $concat);
        } else {
            $signature = hash('md5', $concat);
        }
        return $signature;
    }

    /**
     * @param $secret_word
     * @return bool
     */
    public function ValidChecksum($secret_word) {
        return ($this->CalculateChecksum($secret_word) == $this->getResponseChecksum() ? true : false);
    }
}
