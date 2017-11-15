<?php

namespace grandmasterx\safecharge\api\interfaces;

/**
 * Interface HttpClientInterface
 * @package grandmasterx\safecharge\api\interfaces
 */
interface HttpClientInterface
{

    /**
     * @param ServiceInterface $service
     * @param $requestUrl
     * @param $params
     * @return mixed
     */
    public function requestJson(ServiceInterface $service, $requestUrl, $params);

    /**
     * @param ServiceInterface $service
     * @param $requestUrl
     * @param $params
     * @return mixed
     */
    public function requestPost(ServiceInterface $service, $requestUrl, $params);
}
