<?php

namespace grandmasterx\safecharge\api;

/**
 * Class Utils
 * @package grandmasterx\safecharge\api
 */
class Utils extends \stdClass
{

    /**
     * @param array $params
     * @param array $checksumParamsOrder
     * @param $merchantSecretId
     * @param string $algo
     * @return string
     */
    public static function calculateChecksum(
        array $params,
        array $checksumParamsOrder,
        $merchantSecretId,
        $algo = 'sha256'
    ) {
        $checksumParams = [];
        foreach ($checksumParamsOrder as $value) {
            if (isset($params[$value])) {
                $checksumParams[$value] = $params[$value];
            }
        }
        $concatenatedString = self::arrayToString($checksumParams);
        return hash($algo, $concatenatedString . $merchantSecretId);
    }

    /**
     * @param $array
     * @return string
     */
    public static function arrayToString($array) {
        $string = '';
        foreach ($array as $element) {
            if (!is_array($element)) {
                $string .= $element;
            } else {
                $string .= self::arrayToString($element);
            }
        }
        return $string;
    }
}
