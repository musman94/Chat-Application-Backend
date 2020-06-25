# Chat-Application-Backend
A simple chat app backend built using PHP and SQLite.

## Requirements
There are a few things needed in order to setup this project.
- PHP
- SQLite
- **[Composer](https://getcomposer.org/)**
- **[Slim](http://www.slimframework.com)**

## Installation
Clone this repository and than navigate to the repo's directory.   

- Install the dependencies
```jshelllanguage
$ composer install
```
- Start the server
```jshelllanguage
$ composer start
```

## Implementation

### Summary
**Slim**, which is a PHP micro framework, is being used in this project for routing, dependency injection, middleware. The database is implemented in SQLite. The project is divided into 2 main layers, **Action** and **Domain**. Domain is further divided into **Service** and **Repository** layers. Each of these layers is either a **User** layer or a **Message** layer. 

### Actions
Actions are responsible for controlling the flow of the application over the HTTP requests. There are 2 types of actions in this project, UserActions and MessageActions. Each endpoint is mapped to a action and each of these actions can extend either the **UserAction** or the **MessageAction**. Since each endpoint has its own action, these can be thought of as single action controllers. 

### Services
The main logic is written in the Service layer. The service layer validates the requests, passes them further to the Repository layer, encapsulates the responses from the Repository layer in their respective objects and sends them back. There are 2 kinds of services, **UserService** and **MessageService**.

### Repositories
A Repository is an abstraction of the data layer and only it interacts directly with the database. The main benefit of this is to provide an abstraction to the code so that it is not bothered by how the database is implemented. Or if the database was to be changed, the repository layer will keep on working as before and not break. There are 2 kinds of repositories **UserRepository** and **MessageRepository**.

## API
The routes are defined in the `routes.php` file in the `config` folder. You can read more about each of the endpoints by clicking on their names. 

|Name                                         |route          |method|params              |
|---------------------------------------------|---------------|------|--------------------|
[addUser](examples/user/add.md)               |/users         |POST  |username            |
[sendMessage](examples/message/add.md)        |/messages      |POST  |from, to, body      |
[getMessages](examples/message/getTo.md)      |/messages      |GET   |to                  |

## Database
The `chatDB.db` database is located in the `config` folder. If you need to create it again, use the following command to create the database:   

```jshelllanguage
sqlite3 chatDB.db 
```

And use these queries to insert the users and the messages tables:

```jshelllanguage
CREATE TABLE users(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR NOT NULL
);

CREATE TABLE messages(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  'from' VARCHAR,
  'to' VARCHAR,
  body TEXT NOT NULL,
  time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY('from') REFERENCES users(username),
  FOREIGN KEY('to') REFERENCES users(username)
);
```

## Testing
All of the tests are location in the `tests/TestCase` folder. You can run them by using the following command.

```jshelllanguage
composer test
```

