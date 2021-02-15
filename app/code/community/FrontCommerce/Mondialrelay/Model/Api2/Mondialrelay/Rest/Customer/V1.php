<?php
class FrontCommerce_Mondialrelay_Model_Api2_Mondialrelay_Rest_Customer_V1 extends FrontCommerce_Integration_Model_Api2_Abstract
{
    /**
     * @throw Mage_Api2_Exception
     */
    protected function _retrieveCollection()
    {
        /** @var Mage_Api2_Model_Request */
        $request = $this->getRequest();
        $pickupsClient = Mage::getModel('frontcommerce_mondialrelay/pickups');

        try {
            return array_map(
                function (FrontCommerce_Mondialrelay_Pickup $pickup) {
                    return $pickup->toArray();
                },
                $pickupsClient->fetchPickupList(
                    $request->getParam('countryCode'),
                    $request->getParam('zipcode')
                )
            );
        } catch(FrontCommerce_Mondialrelay_Model_Exception_ApiError $e) {
            throw new Mage_Api2_Exception($e->getMessage(), 400);
        }
    }

    /**
     * @throw Mage_Api2_Exception
     */
    protected function _retrieve()
    {
        /** @var Mage_Api2_Model_Request */
        $request = $this->getRequest();
        $pickupsClient = Mage::getModel('frontcommerce_mondialrelay/pickups');
        try {
            $pickup = $pickupsClient->fetchPickup(
                $request->getParam('countryCode'),
                $request->getParam('id')
            );

            return $pickup->toArray();
        } catch(FrontCommerce_Mondialrelay_Model_Exception_ApiError $e) {
            throw new Mage_Api2_Exception($e->getMessage(), 404);
        }
    }
}
