
# Library Book API

RESTful API for managing a list of books built with Laravel.




## Features

- CRUD Operation: create, read, edit, update books
- Input validation using laravel Request feature
- Response data using laravel Resource Feature
- Test data using Laravel Factory & Seeder
- Unit test to ensure CRUD is working



## Project Setup

```bash
  clone project
  git clone https://github.com/27ksandip/27ksandip-assignment-library-book.git

  cd 27ksandip-assignment-library-book
```
  ### Install Dependencies
    composer install

  ### Copy .env 
    cp .env.example .env

### Generate application key
    php artisan key:generate

### Run migration with test data
    php artisan migrate:fresh --seed

### Run project
    php artisan serve
## API Reference

#### Get all books

```http
GET /api/books
```
    {
        "data": [
            {
                "id": 1,
                "title": "Molestiae officiis natus quod vel rerum natus.",
                "author": "Odie Towne",
                "publication_year": 1538
            },
            {
                "id": 2,
                "title": "Illum asperiores ut aut soluta.",
                "author": "Jalon Ratke Sr.",
                "publication_year": 1992
            }
        ]
    }

#### Get book item

```http
GET /api/books/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

    {
        "id": 1,
        "title": "Dr.",
        "author": "Adah Kulas",
        "publication_year": 1621
    }

#### Create Book

```http
POST /api/books
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Required**|
| `author`      | `string` | **Required**|
| `publication_year`      | `string` | **Required** between 1500 till now|

    {
        "title": "this is test book",
        "author": "sandip",
        "publication_year": "1600"
    }

    Validation error
    {
    "message": "The title field is required. (and 2 more errors)",
    "errors": {
        "title": [
            "The title field is required."
        ],
        "author": [
            "The author field is required."
        ],
        "publication_year": [
            "The publication year field is required."
        ]
    }
    

#### Update Book

```http
PUT /api/books/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Required**|
| `author`      | `string` | **Required**|
| `publication_year`      | `string` | **Required** between 1500 till now|

    {
        "id": 1,
        "title": "update title",
        "author": "update author",
        "publication_year": "1600",
        "created_at": "2025-05-23T07:13:32.000000Z",
        "updated_at": "2025-05-24T03:20:12.000000Z"
    }

#### Delete Book

```http
DELETE /api/books/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `requried` | **to get specific book item**|

    {
        "message": "Book deleted successfully."
    }

## Running Tests

To run tests, run the following command

```bash
  php artisan test  
```

    PASS  Tests\Feature\BookApiTest
    ✓ can create book                                                                                                                                   0.91s  
    ✓ can create book validation error                                                                                                                  0.06s  
    ✓ can list books                                                                                                                                    0.17s  
    ✓ can show book                                                                                                                                     0.03s  
    ✓ can update book                                                                                                                                   0.04s  
    ✓ can delete book                                                                                                                                   0.03s  

    Tests:    6 passed (20 assertions)
    Duration: 1.71s

## FAQ

### Why used "BookResource"

Resource if is very usefull when you want to transform data before sending to user, also its help to improvement on response load

### Why did not used try catch

According to my knowledge try and catch used when you are using third-party api or any complex query where you are not sure what happen next.
In this book library we have validation on store request if any error happen it will catch by validation and if all data send accroding to validation it will create record

### Can we use service class

Yes, we can use service class also using service class is best approach to make clean controller and re-used query.
## Used By

To generate readme file i have used this site 
https://readme.so/
