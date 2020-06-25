# Add User

Add a user to the database with a username.

**URL** : `/users/addUser`

**Method** : `POST`

**Data constraints**

Provide username of the User to be created.

```json
{
    "username": "[chars]"
}
```

**Data example** All fields must be sent.

```json
{
    "username": "user1"
}
```


## Success Response

**Condition** : If everything is OK.

**Code** : `200 SUCCESS`

**Content example**

```json
{
    "statusCode": 200,
    "data": {
        "id": 63,
        "username": "user1"
    }
}

```

## Error Responses

**Condition** : If the username field is missing.

**Code** : `400 BAD REQUEST`

**Content example**

```json
{
    "statusCode": 400,
    "error": {
        "type": "BAD_REQUEST",
        "description": "Could not resolve parameter `username`. Please check your input"
    }
}
```
