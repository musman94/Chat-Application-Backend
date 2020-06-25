# Send Message

Send a message from one user to another.

**URL** : `/messages/sendMessage`

**Method** : `POST`

**Data constraints**

Provide ids of both of the users and a non empty message body. Here from is the sender and to the reciever.

```json
{
    "from": "[int]",
    "to": "[int]",
    "body" : "[text]"
}
```

**Data example** All fields must be sent.

```json
{
    "from": "user1",
    "to":  "user2",
    "body" : "hello" 
}
```

## Success Response

**Condition** : If everything is OK and both of the users exist in the users table.

**Code** : `200 SUCCESS`

**Content example**

```json
{
    "statusCode": 200,
    "data": {
        "from": "1",
        "to": "2",
        "body": "hello"
    }
}
```

## Error Response

**Condition** : If either one or both of the users dont exist in the database.

**Code** : `404 NOT FOUND`

**Content example** :

```json
{
    "statusCode": 500,
    "error": {
        "type": "SERVER_ERROR",
        "description": "Either one or both of the users do not exist"
    }
}
```

### Or

**Condition** : If any of the fields are missing.

**Code** : `400 BAD REQUEST`

**Content example**

```json
{
    "statusCode": 400,
    "error": {
        "type": "BAD_REQUEST",
        "description": "Could not resolve parameter `{field name}`. Please check your input"
    }
}

```
