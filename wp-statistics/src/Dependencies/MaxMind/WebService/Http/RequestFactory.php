<?php

namespace WP_Statistics\Dependencies\MaxMind\WebService\Http;

/**
 * Class RequestFactory.
 *
 * @internal
 */
class RequestFactory
{
    /**
     * Keep the cURL resource here, so that if there are multiple API requests
     * done the connection is kept alive, SSL resumption can be used
     * etcetera.
     *
     * @var resource
     */
    private $ch;

    public function __destruct()
    {
        if (!empty($this->ch)) {
            curl_close($this->ch);
        }
    }

    private function getCurlHandle()
    {
        if (empty($this->ch)) {
            $this->ch = curl_init();
        }

        return $this->ch;
    }

    /**
     * @param string $url
     * @param array  $options
     *
     * @return Request
     */
    public function request($url, $options)
    {
        $options['curlHandle'] = $this->getCurlHandle();

        return new CurlRequest($url, $options);
    }
}
