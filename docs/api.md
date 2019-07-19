# Currency exchanges

- Check latest exchange rate (for all supported currencies)
- Update exchange rates

## Enpoints

### Get a list of all currencies in the system

Maybe we could include here the rates and remove the `GET /currencies/exchange-rates` endpoint.
But it could be too many data and an endpoint to ask for just currencies makes sense.

`GET /currencies`

Returns a 200 HTTP Response with this content:
```
[
    {
        "id": "euro",
        "symbol": "€"
    },
    {
        "id": "dollar",
        "symbol": "$"
    },
    {
        "id": "pound",
        "symbol": "£"
    }
]
```

### Get exchanges rates for all currencies

`GET /currencies/exchange-rates`

Returns a 200 HTTP Response with this content:
```
[
    {
        "id": "euro",
        "rates": [
            {
                "id": "dollar",
                "value": 1.12
            },
            {
                "id": "pound",
                "value": 0.90
            }
        ]
    },
    {
        "id": "dollar",
        "rates": [
            {
                "id": "euro",
                "value": 0.89
            },
            {
                "id": "pound",
                "value": 0.80
            }
        ]
    },
    {
        "id": "pound",
        "rates": [
            {
                "id": "euro",
                "value": 1.11
            },
            {
                "id": "dollar",
                "value": 1.25
            }
        ]
    }
]
```

### Get exchanges rates for specific currency

`GET /currencies/euro/exchange-rates`

Returns a 200 HTTP Response with this content:
```
[
    {
        "id": "dollar",
        "value": 1.12
    },
    {
        "id": "pound",
        "value": 0.90
    }
]
```

### Update rates for an specific currency

To update the exchange rates for euro currency:

`PUT /currencies/euro`

Accepts a json with currencies values to update for a given currency
```
[
    {
        "id": "dollar",
        "value": 1
    },
    {
        "id": "pound",
        "value": 1
    }
]
```

It will return a 200 HTTP response on success

### Update rates for every currency

`PUT /currencies/exchange-rates`

```
[
    {
        "id": "euro",
        "rates": [
            {
                "id": "dollar",
                "value": 1.5
            },
            {
                "id": "pound",
                "value": 1.5
            }
        ]
    },
    {
        "id": "dollar",
        "rates": [
            {
                "id": "euro",
                "value": 2
            },
            {
                "id": "pound",
                "value": 2
            }
        ]
    },
    {
        "id": "pound",
        "rates": [
            {
                "id": "euro",
                "value": 1.21
            },
            {
                "id": "dollar",
                "value": 1.22
            }
        ]
    }
]
```

It will return a 200 HTTP response on success

