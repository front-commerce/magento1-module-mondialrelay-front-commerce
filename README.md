# Mondial Relay Magento 1 Front Commerce package

Provides an integration between Man4x_MondialRelay and Front Commerce Magento1
modules.

## API

### Get a list of Mondial Relay pickup points for a zipcode (and a country code)

URL: `/api/rest/frontcommerce/mondialrelay/:countryCode/:zipcode/pickups`

<details>
<summary>Example getting a list of pickup near the zipcode 01240 in France:</summary>
```
curl -s http://magento1.test/api/rest/frontcommerce/mondialrelay/fr/01240/pickups
[
  {
    "id": "005317",
    "name": "INTERMARCHE SERVAS",
    "street": [
      "50 RUE DES ACACIAS"
    ],
    "zipcode": "01960",
    "city": "SERVAS",
    "latitude": 46.1498497,
    "longitude": 5.1502203,
    "countryCode": "FR",
    "distance": 10736,
    "schedule": {
      "monday": "08h30 - 19h30",
      "tuesday": "08h30 - 19h30",
      "wednesday": "08h30 - 19h30",
      "thursday": "08h30 - 19h30",
      "friday": "08h30 - 19h30",
      "saturday": "08h30 - 19h30"
    }
  },
  {
    "id": "066605",
    "name": "ELEVAGE LA PASSE DE L EIDER",
    "street": [
      "LA GRANGE DU BOIS"
    ],
    "zipcode": "01320",
    "city": "CHATILLON LA PALUD",
    "latitude": 45.980114,
    "longitude": 5.2171326,
    "countryCode": "FR",
    "distance": 11926,
    "schedule": {
      "monday": "08h30 - 12h00 / 14h00 - 18h00",
      "tuesday": "08h30 - 12h00 / 14h00 - 18h00",
      "wednesday": "08h30 - 12h00 / 14h00 - 18h00",
      "thursday": "08h30 - 12h00 / 14h00 - 18h00",
      "friday": "08h30 - 12h00 / 14h00 - 18h00",
      "saturday": "08h30 - 12h00 / 14h00 - 18h00",
      "sunday": "08h30 - 12h00 / 14h00 - 18h00"
    }
  },
  {
    "id": "010865",
    "name": "TLG",
    "street": [
      "209 PLACE DU MARCHE"
    ],
    "zipcode": "01330",
    "city": "VILLARS LES DOMBES",
    "latitude": 46.002133,
    "longitude": 5.0293353,
    "countryCode": "FR",
    "distance": 13375,
    "schedule": {
      "monday": "09h00 - 12h00 / 13h00 - 17h00",
      "tuesday": "09h00 - 12h00 / 13h00 - 17h00",
      "wednesday": "09h00 - 12h00 / 13h00 - 17h00",
      "thursday": "09h00 - 12h00 / 13h00 - 17h00",
      "friday": "09h00 - 12h00 / 13h00 - 17h00",
      "saturday": "09h00 - 13h00"
    }
  },
  {
    "id": "011752",
    "name": "LA MAISON CONNECTEE",
    "street": [
      "725 AVENUE CHARLES DE GAULLE"
    ],
    "zipcode": "01330",
    "city": "VILLARS-LES-DOMBES",
    "latitude": 46.000204,
    "longitude": 5.0300625,
    "countryCode": "FR",
    "distance": 13375,
    "schedule": {
      "monday": "09h00 - 12h00 / 15h00 - 19h00",
      "tuesday": "09h00 - 12h00 / 15h00 - 19h00",
      "wednesday": "09h00 - 12h00",
      "thursday": "09h00 - 12h00 / 15h00 - 19h00",
      "friday": "09h00 - 12h00 / 15h00 - 19h00",
      "saturday": "09h00 - 12h00 / 15h00 - 18h00"
    }
  },
  {
    "id": "009632",
    "name": "CELLIER DOMBES BRESSE",
    "street": [
      "PLACE DU CHAMP DE FOIRE"
    ],
    "zipcode": "01400",
    "city": "CH TILLON-SUR-CHALARONNE",
    "latitude": 46.1211907,
    "longitude": 4.9583214,
    "countryCode": "FR",
    "distance": 13558,
    "schedule": {
      "tuesday": "09h00 - 12h00 / 15h00 - 18h30",
      "wednesday": "09h00 - 12h00 / 15h00 - 18h30",
      "thursday": "09h00 - 12h00 / 15h00 - 18h30",
      "friday": "09h00 - 12h00 / 15h00 - 18h30",
      "saturday": "09h00 - 12h45 / 14h30 - 18h30"
    }
  },
  {
    "id": "009187",
    "name": "TORREFACTION DES DOMBES",
    "street": [
      "60 RUE ALPHONSE BAUDIN"
    ],
    "zipcode": "01400",
    "city": "CH TILLON-SUR-CHALARONNE",
    "latitude": 46.1196932,
    "longitude": 4.9568176,
    "countryCode": "FR",
    "distance": 13562,
    "schedule": {
      "tuesday": "09h30 - 13h00 / 14h30 - 18h30",
      "wednesday": "08h30 - 13h00 / 14h00 - 17h45",
      "thursday": "08h30 - 13h00 / 14h00 - 17h45",
      "friday": "08h30 - 13h00 / 14h00 - 17h45",
      "saturday": "08h30 - 13h00 / 14h00 - 17h45"
    }
  },
  {
    "id": "011867",
    "name": "MEDIA SERVICES 2.0",
    "street": [
      "14 PLACE JOUBERT"
    ],
    "zipcode": "01000",
    "city": "BOURG-EN-BRESSE",
    "latitude": 46.2032339,
    "longitude": 5.2218186,
    "countryCode": "FR",
    "distance": 14016,
    "schedule": {
      "monday": "08h30 - 18h00",
      "tuesday": "08h30 - 18h00",
      "wednesday": "08h30 - 18h00",
      "thursday": "08h30 - 18h00",
      "friday": "08h30 - 18h00",
      "saturday": "09h00 - 14h30"
    }
  },
  {
    "id": "012245",
    "name": "CA CREE CA CAUSE",
    "street": [
      "13 A AVENUE ALPHONSE BAUDIN"
    ],
    "zipcode": "01000",
    "city": "BOURG-EN-BRESSE",
    "latitude": 46.2003157,
    "longitude": 5.2172587,
    "countryCode": "FR",
    "distance": 14016,
    "schedule": {
      "tuesday": "10h00 - 12h00 / 14h00 - 19h00",
      "wednesday": "10h00 - 12h00 / 14h00 - 19h00",
      "thursday": "10h00 - 12h00 / 14h00 - 19h00",
      "friday": "10h00 - 12h00 / 14h00 - 19h00",
      "saturday": "10h00 - 12h00 / 14h00 - 19h00"
    }
  },
  {
    "id": "048496",
    "name": "PRESSING DE BROU",
    "street": [
      "102 BOULEVARD DE BROU"
    ],
    "zipcode": "01000",
    "city": "BOURG EN BRESSE",
    "latitude": 46.201057,
    "longitude": 5.232539,
    "countryCode": "FR",
    "distance": 14016,
    "schedule": {
      "tuesday": "08h30 - 18h30",
      "wednesday": "08h30 - 18h30",
      "thursday": "08h30 - 18h30",
      "friday": "08h30 - 18h30",
      "saturday": "08h30 - 13h30"
    }
  },
  {
    "id": "000244",
    "name": "WELDOM",
    "street": [
      "16 RUE DES PRES DE BROU",
      "ZAC DE LA CROIX BLANCHE"
    ],
    "zipcode": "01000",
    "city": "BOURG EN BRESSE",
    "latitude": 46.199891,
    "longitude": 5.244803,
    "countryCode": "FR",
    "distance": 14017,
    "schedule": {
      "monday": "09h00 - 18h00",
      "tuesday": "09h00 - 18h00",
      "wednesday": "09h00 - 18h00",
      "thursday": "09h00 - 18h00",
      "friday": "09h00 - 18h00",
      "saturday": "09h00 - 18h00"
    }
  }
]
```
</details>

### Get the details about a pickup point

URL: `/api/rest/frontcommerce/mondialrelay/:countryCode/pickup/:pickupId`

<details>
<summary>Example getting the details about the pickup with the id `009187` in France:</summary>
```
curl -s http://magento1.test/api/rest/frontcommerce/mondialrelay/fr/pickups/012245
{
  "id": "012245",
  "name": "CA CREE CA CAUSE",
  "street": [
    "13 A AVENUE ALPHONSE BAUDIN"
  ],
  "zipcode": "01000",
  "city": "BOURG-EN-BRESSE",
  "latitude": 46.2003157,
  "longitude": 5.2172587,
  "countryCode": "FR",
  "distance": 0,
  "schedule": {
    "tuesday": "10h00 - 12h00 / 14h00 - 19h00",
    "wednesday": "10h00 - 12h00 / 14h00 - 19h00",
    "thursday": "10h00 - 12h00 / 14h00 - 19h00",
    "friday": "10h00 - 12h00 / 14h00 - 19h00",
    "saturday": "10h00 - 12h00 / 14h00 - 19h00"
  }
}
```
</details>

## Choosing a pickup point

With this module, a Mondial Relay pickup point can be chosen. For this to work,
when Mondial Relay pickups shipping method has been choosen, the API expects
`additional_data` array to contain an object with the following structure:

```json
{
  "key": "pickup",
  "value": {
    "id": "012245",
    "name": "CA CREE CA CAUSE",
    "street": "13 AVENUE ALPHONSE BAUDIN",
    "zipcode": "01000",
    "city": "BOURG-EN-BRESSE",
    "countryCode": "FR"
  }
}
```
