# Get Messages

Get all of the messages where the specified user was the reciever.

**URL** : `/messages/getMessages`

**Method** : `GET`

**Data constraints**

Provide id of the user who was the reciever. Here that corresponds to the to field. 

```json
{
    "to": "[int]"
}
```

**Data example** All fields must be sent.

```json
{
    "to": "2"
}
```


## Success Response

**Condition** : If everything goes fine.

**Code** : `200 SUCCESS`

**Content example**

```json
{
    "statusCode": 200,
    "data": [
        {
            "from": "1",
            "to": "2",
            "body": "Hey"
        },
        {
            "from": "1",
            "to": "2",
            "body": "sup?"
        }
    ]
}
```

## Error Response

**Condition** : If the `to` field is missing.

**Code** : `400 BAD REQUEST`

**Content example**

```json
{
    "statusCode": 400,
    "error": {
        "type": "BAD_REQUEST",
        "description": "Could not resolve parameter `to`. Please check your input"
    }
}

```