<?php
class FrontCommerce_Mondialrelay_Model_Pickups
{
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new SoapClient(Mage::getStoreConfig('carriers/mondialrelay/url_ws', true));
    }

    private function signParameters(array $parameters): array
    {
        $code = implode('', $parameters);
        $code .= Mage::getStoreConfig('carriers/mondialrelay/key_ws', true);
        $parameters['Security'] = strtoupper(md5($code));
        return $parameters;
    }

    /**
     * @return array|stdClass depending on the search parameters
     * @throw FrontCommerce_Mondialrelay_Model_Exception_ApiError
     */
    private function _doSearch(array $parameters)
    {
        $signedParameters = $this->signParameters($parameters);
        $result = $this->soapClient->WSI4_PointRelais_Recherche($signedParameters);
        if (!isset($result->WSI4_PointRelais_RechercheResult)) {
            throw new FrontCommerce_Mondialrelay_Model_Exception_ApiError("Unknown Mondialrelay API issue");
        }
        $searchResult = $result->WSI4_PointRelais_RechercheResult;
        $statusCode = (int)$searchResult->STAT;
        if ((int)$statusCode !== 0)
        {
            throw new FrontCommerce_Mondialrelay_Model_Exception_ApiError(
                sprintf(
                    "Mondialrelay API answers with an error '%d': '%s'",
                    $statusCode,
                    Mage::helper('mondialrelay')->convertStatToTxt($statusCode)
                )
            );
        }

        return $searchResult->PointsRelais->PointRelais_Details;
    }

    /**
     * @return FrontCommerce_Mondialrelay_Pickup[]
     * @throw FrontCommerce_Mondialrelay_Model_Exception_ApiError
     */
    public function fetchPickupList(string $countryCode, string $zipcode): array
    {
        $parameters = array(
            'Enseigne'  => Mage::getStoreConfig('carriers/mondialrelay/company', true),
            'Pays' => $countryCode,
            'CP' => $zipcode,
            'NombreResultats' => (int) Mage::getStoreConfig('carriers/mondialrelaypickup/relay_count', true),
        );
        $result = (array) $this->_doSearch($parameters);
        return array_map(function ($pickup) {
            return FrontCommerce_Mondialrelay_Pickup::fromMondialRelayResult($pickup);
        }, $result);
    }

    /**
     * @throw FrontCommerce_Mondialrelay_Model_Exception_ApiError
     */
    public function fetchPickup(string $countryCode, string $id): FrontCommerce_Mondialrelay_Pickup
    {
        $parameters = array(
            'Enseigne' => Mage::getStoreConfig('carriers/mondialrelay/company', true),
            'NumPointRelais' => $id,
            'Pays' => $countryCode,
        );
        $pickup = $this->_doSearch($parameters);
        return FrontCommerce_Mondialrelay_Pickup::fromMondialRelayResult($pickup);
    }
}
