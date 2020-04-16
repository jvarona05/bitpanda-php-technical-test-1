---
title: API Reference

language_tabs:
- bash
- javascript
- php

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Users


<!-- START_1aff981da377ba9a1bbc56ff8efaec0d -->
## Get Users

Returns users filtered by country and status.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users?country=RU&active=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users"
);

let params = {
    "country": "RU",
    "active": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/users',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'country'=> 'RU',
            'active'=> '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "type": "user",
            "attributes": {
                "email": "rerere@test_mail.com",
                "active": 1,
                "first_name": "Igor",
                "last_name": "Snow",
                "phone_number": "0043664777777"
            },
            "id": 7
        },
        {
            "type": "user",
            "attributes": {
                "email": "jose.varona02@gmail.com",
                "active": 1,
                "first_name": "José Manuel",
                "last_name": "Rodríguez",
                "phone_number": "000000000"
            },
            "id": 8
        }
    ]
}
```

### HTTP Request
`GET api/v1/users`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `country` |  optional  | Country iso2 code.
    `active` |  optional  | The user status.

<!-- END_1aff981da377ba9a1bbc56ff8efaec0d -->

<!-- START_220f0ffa0999a0f812939e384addae84 -->
## Get Austrian Users

Returns all the users which are `active` (users table) and have an Austrian citizenship.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/austria/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/austria/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/austria/users',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "data": [
        {
            "type": "user",
            "attributes": {
                "email": "alex@tempmail.com",
                "active": 1,
                "first_name": "Alex",
                "last_name": "Petro",
                "phone_number": "0043664111111"
            },
            "id": 1
        },
        {
            "type": "user",
            "attributes": {
                "email": "Taaaaaaa@test.com",
                "active": 1,
                "first_name": "Max",
                "last_name": "Mustermann",
                "phone_number": "00436646666666"
            },
            "id": 6
        }
    ]
}
```

### HTTP Request
`GET api/v1/austria/users`


<!-- END_220f0ffa0999a0f812939e384addae84 -->

<!-- START_d06c57308ee68dc40d506d3cca59c67c -->
## Update User Details

It will allow you to edit user details just if the user details are there already.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/users/1/details" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"citizenship_country_id":2,"first_name":"Jose Manuel","last_name":"Rodriguez Varona","phone_number":"000000000"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/1/details"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "citizenship_country_id": 2,
    "first_name": "Jose Manuel",
    "last_name": "Rodriguez Varona",
    "phone_number": "000000000"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/users/1/details',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'citizenship_country_id' => 2,
            'first_name' => 'Jose Manuel',
            'last_name' => 'Rodriguez Varona',
            'phone_number' => '000000000',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "success": true,
    "message": "Succesfully"
}
```
> Example response (500):

```json
{
    "success": false,
    "message": "The user doesn't have details"
}
```

### HTTP Request
`PUT api/v1/users/{id}/details`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The User ID.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `citizenship_country_id` | integer |  required  | Country id.
        `first_name` | string |  required  | User Firstname.
        `last_name` | string |  required  | User Lastname.
        `phone_number` | string |  required  | User Phonenumber.
    
<!-- END_d06c57308ee68dc40d506d3cca59c67c -->

<!-- START_8b97688fa48f9a3858d3b640a906b76b -->
## Delete User

It will allow you to delete a user just if no user details exist yet.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/users/nulla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users/nulla"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost/api/v1/users/nulla',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "success": true,
    "message": "Succesfully"
}
```
> Example response (500):

```json
{
    "success": false,
    "message": "The user cannot be deleted because it has details"
}
```

### HTTP Request
`DELETE api/v1/users/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The User ID.

<!-- END_8b97688fa48f9a3858d3b640a906b76b -->


