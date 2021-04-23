<?php

class FrontCommerce_Mondialrelay_Model_Observer_Pickup
{
    const MONDIAL_RELAY_PICKUP_CARRIER_CODE = 'mondialrelaypickup';
    const SEPARATOR = "\t\t";

    public function setPickupAsShippingAddress(Varien_Event_Observer $observer)
    {
        /** @var array */
        $shippingData = $observer->getShippingData();
        if (!$this->isMondialRelayPickupShipping($shippingData)) {
            return;
        }
        /** @var Mage_Checkout_Model_Type_Onepage */
        $onepage = $observer->getOnepage();
        $pickup = $this->findPickupData($shippingData['additional_data']);
        $pickupMethod = $shippingData['shipping_carrier_code'].'_'.$shippingData['shipping_method_code'];

        $quote = $onepage->getQuote();
        $shippingAddress = $quote->getShippingAddress();
        $shippingAddress
            ->setCompany($pickup['name'])
            ->setStreet($pickup['street'])
            ->setPostcode($pickup['zipcode'])
            ->setCity($pickup['city'])
            ->setCountryId($pickup['countryCode'])
            ->setCustomerNotes(
                // this is a complete hack, see below
                $this->formatCustomerNotes((string)$shippingAddress->getCustomerNotes(), $pickup['id'])
            )
            ->setShippingMethod($pickupMethod);
    }

    private function findPickupData($additionalData): array
    {
        foreach ($additionalData as $data) {
            if ($data['key'] === "pickup") {
                return $data['value'];
            }
        }
        throw new UnexpectedValueException("additional_data does not include a pickup");
    }

    private function formatCustomerNotes(string $existingNotes, string $pickupId): string
    {
        return sprintf("%s%s%s", $existingNotes, self::SEPARATOR, $pickupId);
    }

    private function parsePickupIdFromNotes(string $notes): stdClass
    {
        list($notes, $pickupId) = explode(self::SEPARATOR, $notes);

        return (object) ['notes' => $notes, 'id' => $pickupId];
    }

    private function isMondialRelayPickupShipping(array $shippingData): bool
    {
        return isset($shippingData['shipping_carrier_code']) && $shippingData['shipping_carrier_code'] === self::MONDIAL_RELAY_PICKUP_CARRIER_CODE;
    }

    public function setOrderShippingMethod(Varien_Event_Observer $observer)
    {
        $quote = $observer->getQuote();
        $shippingAddress = $quote->getShippingAddress();
        if (strpos($shippingAddress->getShippingMethod(), self::MONDIAL_RELAY_PICKUP_CARRIER_CODE) === false) {
            return;
        }

        // This is a complete hack to reproduce the hack on which
        // Man4x_MondialRelay relies on. Man4x_MondialRelay needs the order's
        // shipping method to be 'mondialrelaypickup_24R_XXXXX' where XXXXX is
        // the pickup id, but we can not set it on the quote so that the final
        // order gets it as well. So in setPickupAsShippingAddress above we forge
        // the customer notes field to include it so that later (on
        // checkout_type_onepage_save_order_after ie after the order has been
        // created from the Onepage object) we can build here the expected
        // method string and restore the customer notes field…
        $parsedNotes = $this->parsePickupIdFromNotes($shippingAddress->getCustomerNotes());
        $pickupId = $parsedNotes->id;
        $shippingMethod = $shippingAddress->getShippingMethod().'_'.$pickupId;
        $order = $observer->getOrder();
        $order->setShippingMethod($shippingMethod);
        $order->save();
        $shippingAddress->setCustomerNotes($parsedNotes->notes);
        $shippingAddress->save();
    }
}
