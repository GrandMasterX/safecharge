<?php

namespace grandmasterx\safecharge\api\interfaces;

use grandmasterx\safecharge\api\RestClient;

/**
 * Interface ServiceInterface
 * @package grandmasterx\safecharge\api\interfaces
 */
interface ServiceInterface
{

    /**
     * ServiceInterface constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client);

    /**
     * @return mixed
     */
    public function getClient();

    /**
     * @param $params
     * @param $endpoint
     * @return mixed
     */
    public function requestJson($params, $endpoint);

    /**
     * @param $params
     * @param $endpoint
     * @return mixed
     */
    public function requestPost($params, $endpoint);
}
