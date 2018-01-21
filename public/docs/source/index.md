---
title: API Reference

language_tabs:
- bash
- javascript

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

#Book
<!-- START_81570fe29be54336ca67a7f3c307e51d -->
## Book List

Displays all books with details.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/books" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "title": "At vero eos",
            "author": "Lorem Ipsum",
            "price": 15,
            "stock": 10,
            "href": {
                "link": "http:\/\/localhost\/api\/v1\/books\/1"
            }
        },
        {
            "title": "Sed ut perspiciatis ",
            "author": "Molre Spoif",
            "price": 10,
            "stock": 10,
            "href": {
                "link": "http:\/\/localhost\/api\/v1\/books\/2"
            }
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/books?page=1",
        "last": "http:\/\/localhost\/api\/v1\/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/books",
        "per_page": 10,
        "to": 2,
        "total": 2
    }
}
```

### HTTP Request
`GET api/v1/books`

`HEAD api/v1/books`


<!-- END_81570fe29be54336ca67a7f3c307e51d -->

<!-- START_52dfba10ecc5dfbebbd86bdad94a4ba8 -->
## Book Create

Store a newly created book in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/books" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "title"="cum"
    -d "description"="cum"
    -d "author_first_name"="cum"
    -d "author_last_name"="cum"
    -d "price"="67"
    -d "stock"="68"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books",
    "method": "POST",
    "data": {
        "title": "cum",
        "description": "cum",
        "author_first_name": "cum",
        "author_last_name": "cum",
        "price": 67,
        "stock": 68
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/books`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Maximum: `191`
    description | string |  required  | 
    author_first_name | string |  required  | 
    author_last_name | string |  required  | 
    price | string |  required  | Between: `0` and `99.99`
    stock | integer |  required  | Minimum: `0` Maximum: `100`

<!-- END_52dfba10ecc5dfbebbd86bdad94a4ba8 -->

<!-- START_a5bf2d508ab578edc135a330ff7e0479 -->
## Book View

Displays the selected book's details.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/books/{book}" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books/{book}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "title": "At vero eos",
        "decription": "Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.",
        "author": "Lorem Ipsum",
        "price": 15,
        "stock": 10,
        "seller": {
            "name": "Juan Dela Cruz",
            "email": "juan.d@example.com"
        }
    }
}
```

### HTTP Request
`GET api/v1/books/{book}`

`HEAD api/v1/books/{book}`


<!-- END_a5bf2d508ab578edc135a330ff7e0479 -->

<!-- START_dda6a15c7fc613d6fd4cfdf821db8f8a -->
## Book Update

Update the specified book in storage.

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/books/{book}" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "title"="molestias"
    -d "description"="molestias"
    -d "author_first_name"="molestias"
    -d "author_last_name"="molestias"
    -d "price"="50"
    -d "stock"="51"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books/{book}",
    "method": "PUT",
    "data": {
        "title": "molestias",
        "description": "molestias",
        "author_first_name": "molestias",
        "author_last_name": "molestias",
        "price": 50,
        "stock": 51
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/books/{book}`

`PATCH api/v1/books/{book}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Maximum: `191`
    description | string |  required  | 
    author_first_name | string |  required  | 
    author_last_name | string |  required  | 
    price | string |  required  | Between: `0` and `99.99`
    stock | integer |  required  | Minimum: `0` Maximum: `100`

<!-- END_dda6a15c7fc613d6fd4cfdf821db8f8a -->

<!-- START_16fc4b51a90879e1074166cd69c832de -->
## Book Delete

Soft deletes the specified book. It can be viewed through the history.

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/books/{book}" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books/{book}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/books/{book}`


<!-- END_16fc4b51a90879e1074166cd69c832de -->

#History
<!-- START_830df72dbe41bd4dbf1aac9b6d7a3a47 -->
## History List

Display a listing of the deleted books.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/history" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/history",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "title": "At vero eos",
            "author": "Lorem Ipsum",
            "price": 15,
            "stock": 10,
            "href": {
                "link": "http:\/\/localhost\/api\/v1\/history\/1",
                "link_restore": "http:\/\/localhost\/api\/v1\/history\/1\/restore"
            }
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/history?page=1",
        "last": "http:\/\/localhost\/api\/v1\/history?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/history",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### HTTP Request
`GET api/v1/history`

`HEAD api/v1/history`


<!-- END_830df72dbe41bd4dbf1aac9b6d7a3a47 -->

<!-- START_68f7623f1415970ec6d5d1bf033ae077 -->
## History View

View a specified book from the history.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/history/{history}" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/history/{history}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "title": "At vero eos",
        "decription": "Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.",
        "author": "Lorem Ipsum",
        "price": 15,
        "stock": 10,
        "seller": {
            "name": "Juan Dela Cruz",
            "email": "juan.d@example.com"
        },
        "href": {
            "link": "http:\/\/localhost\/api\/v1\/history\/1",
            "link_restore": "http:\/\/localhost\/api\/v1\/history\/1\/restore"
        }
    }
}
```

### HTTP Request
`GET api/v1/history/{history}`

`HEAD api/v1/history/{history}`


<!-- END_68f7623f1415970ec6d5d1bf033ae077 -->

<!-- START_322f8c4722e4b3d258a9660687b2dedd -->
## History Force Delete

Force delete the specified book from the app.

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/history/{history}/delete" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/history/{history}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/history/{history}/delete`


<!-- END_322f8c4722e4b3d258a9660687b2dedd -->

<!-- START_7f293dcf336b963207f117d83d609020 -->
## History Restore

Restore a specified book from the history.

> Example request:

```bash
curl -X PUT "http://localhost/api/v1/history/{history}/restore" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/history/{history}/restore",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/v1/history/{history}/restore`

`PATCH api/v1/history/{history}/restore`


<!-- END_7f293dcf336b963207f117d83d609020 -->

#Purchase
<!-- START_49a340b2a8732c2ffbde1ae2c3a6b235 -->
## Book Purchase

A customer purchases a book.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/books/{book}/purchase" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "quantity"="359513573"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/books/{book}/purchase",
    "method": "POST",
    "data": {
        "quantity": 359513573
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/books/{book}/purchase`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    quantity | integer |  required  | Minimum: `0`

<!-- END_49a340b2a8732c2ffbde1ae2c3a6b235 -->

#Search
<!-- START_e19c9e19f1f1208528a69cd2ef4c01dd -->
## Book Search

Search the database for a desired book.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/search" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "keyword"="aut"
    -d "author"="aut"
    -d "price"="1"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/search",
    "method": "GET",
    "data": {
        "keyword": "aut",
        "author": "aut",
        "price": 1
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "title": "Sed ut perspiciatis ",
            "author": "Molre Spoif",
            "price": 10,
            "stock": 10,
            "href": {
                "link": "http:\/\/localhost\/api\/v1\/books\/2"
            }
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/search?page=1",
        "last": "http:\/\/localhost\/api\/v1\/search?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/search",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### HTTP Request
`GET api/v1/search`

`HEAD api/v1/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    keyword | string |  optional  | 
    author | string |  optional  | 
    price | numeric |  optional  | Between: `0` and `99.99`

<!-- END_e19c9e19f1f1208528a69cd2ef4c01dd -->

#User
<!-- START_b2892eb191cd19c0a6f1aae56ba43db4 -->
## User View

Displays user information.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/user" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "first_name": "Juan",
        "last_name": "Dela Cruz",
        "email": "juan.d@example.com",
        "books": {
            "count": 1,
            "href": [
                "http:\/\/localhost\/api\/v1\/books\/1"
            ]
        }
    }
}
```

### HTTP Request
`GET api/v1/user`

`HEAD api/v1/user`


<!-- END_b2892eb191cd19c0a6f1aae56ba43db4 -->

<!-- START_7a184547882598fc164c10be7745584b -->
## User Login

Fetches an access token to be used as an authentication for the API.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/login" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "email"="clarabelle94@example.net"
    -d "password"="excepturi"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/user/login",
    "method": "POST",
    "data": {
        "email": "clarabelle94@example.net",
        "password": "excepturi"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user/login`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Maximum: `191`
    password | string |  required  | 

<!-- END_7a184547882598fc164c10be7745584b -->

<!-- START_7fef01e7235c89049ebe3685de4bff17 -->
## User Registration

Creates a new user.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/user/register" 
-H "Accept: application/json"
-H "Content-Type: application/json"
 
    -d "first_name"="omnis"
    -d "last_name"="omnis"
    -d "email"="wjones@example.net"
    -d "password"="omnis"
    -d "password_confirmation"="omnis"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/user/register",
    "method": "POST",
    "data": {
        "first_name": "omnis",
        "last_name": "omnis",
        "email": "wjones@example.net",
        "password": "omnis",
        "password_confirmation": "omnis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  required  | Maximum: `191`
    last_name | string |  required  | Maximum: `191`
    email | email |  required  | Maximum: `191`
    password | string |  required  | Minimum: `6`
    password_confirmation | string |  required  | Minimum: `6`

<!-- END_7fef01e7235c89049ebe3685de4bff17 -->

<!-- START_ad438fdc8fd9eb9c3c9574f2c6d69dc2 -->
## User&#039;s Book List

Displays a list of all books created by the user.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/user/books" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/user/books",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "title": "At vero eos",
            "author": "Lorem Ipsum",
            "price": 15,
            "stock": 10,
            "href": {
                "link": "http:\/\/localhost\/api\/v1\/books\/1"
            }
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/user\/books?page=1",
        "last": "http:\/\/localhost\/api\/v1\/user\/books?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/user\/books",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### HTTP Request
`GET api/v1/user/books`

`HEAD api/v1/user/books`


<!-- END_ad438fdc8fd9eb9c3c9574f2c6d69dc2 -->

<!-- START_27580d738581bcd5d0455d12d46d5e00 -->
## User&#039;s Purchase List

Displays a list of all book purchases by the user.

> Example request:

```bash
curl -X GET "http://localhost/api/v1/user/purchases" 
-H "Accept: application/json"
-H "Content-Type: application/json"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/user/purchases",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "book": {
                "title": "Sed ut perspiciatis ",
                "author": "Molre Spoif",
                "price": 10,
                "href": {
                    "link": "http:\/\/localhost\/api\/v1\/books\/2"
                }
            },
            "customer": {
                "name": "Juan Dela Cruz",
                "email": "juan.d@example.com"
            },
            "quantity": 1,
            "seller": {
                "name": "John Smith",
                "email": "john.s@example.com"
            }
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/v1\/user\/purchases?page=1",
        "last": "http:\/\/localhost\/api\/v1\/user\/purchases?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost\/api\/v1\/user\/purchases",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### HTTP Request
`GET api/v1/user/purchases`

`HEAD api/v1/user/purchases`


<!-- END_27580d738581bcd5d0455d12d46d5e00 -->

