# News Aggregator Project 
It's about a News Aggregator Project that brings news from 2 different URLs.

On the main page, unauthenticated users can read the news and select filters located at the top left corner of the page. The system administrators logs in using their credentials and has various functions they can perform on their dashboard page.Specifically, they can start the scrapers to load the news into the database, and consequently onto the main page for unauthenticated users. They can also perform CRUD operations on each news article.Further information to view and run the program, as well as the admin credentials, can be found below.

# CodeIgniter
CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter built from the development repository.

More information about the plans for version 4 can be found in [CodeIgniter 4 on the forums](https://forum.codeigniter.com/forum-28.html).


## Installation & Setup

### Prerequisites
- PHP version 8.1 or higher
- Composer
- MySQL
- XAMPP (recommended for local development)

  
### Clone the Repository
``` 
git clone https://github.com/iouliakan/NewsAggregator.git
cd NewsAggregator
```
-Install Dependencies
```
composer install 
````

-Environment Setup
Copy the `env` file to create a new `.env` file: 
```
cp env .env
```

-Edit the env file to set your database credentials ant the base URL for the application
``` 
app.baseURL = 'http://localhost/NewsAggregator'
database.default.hostname = localhost
database.default.database = newsaggregator
database.default.username = your_db_username
database.default.password = your_db_password
database.default.DBDriver = MySQLi
```

### Database Setup  
-Create a new database in MYSQL or MariaDB named 'newsaggregator' 
-Run the database migrations and seeders to set up the initial database schema and data: 
``` 
php spark migrate
php spark db:seed AdminSeeder
php spark db:seed NewsSeeder
```

**Start the Development Server**
```
php spark serve
```

### Access the Application
Open your web browser and navigate to `http://localhost:8080`


**To access the admin functions, you'll need to log in with the admin credentials. The default admin credentials can be found in the AdminSeeder class. For security reasons, make sure to change these credentials after the initial setup.**

### External Libraries Used
The project uses the following external libraries:
- GuzzleHttp\Client: For making HTTP requests.
- Symfony\Component\DomCrawler\Crawler: For parsing HTML. 
These libraries are included in the `composer.json` file and will be installed automatically when you run `composer install`.


### Server Requirements
PHP version 8.1 or higher is required, with the following extensions installed:

-intl
-mbstring
-json (enabled by default - don't turn it off)
-mysqlnd (if you plan to use MySQL)
-libcurl (if you plan to use the HTTP\CURLRequest library)


### Security Considerations 
Ensure your .env file is not committed to your repository by adding it to your .gitignore. Sensitive information such as database credentials and secret keys should not be exposed in your version control system.


### Contributing
If you would like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.


