# News Aggregator Project 

# What is CodeIgniter?
CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter built from the development repository.

More information about the plans for version 4 can be found in [CodeIgniter 4 on the forums](https://forum.codeigniter.com/forum-28.html).

You can read the user guide corresponding to the latest version of the framework [here](https://codeigniter.com/userguide4/).

## Installation & Setup

### Prerequisites
- PHP version 8.1 or higher
- Composer
- MySQL or MariaDB
- XAMPP (recommended for local development)

- 
### Clone the Repository
``` 
git clone https://github.com/yourusername/NewsAggregator.git
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

-Edit the env file to set your database credentials ant the base URL for the applications 
``` 
app.baseURL = 'http://localhost/NewsAggregator'
database.default.hostname = localhost
database.default.database = newsaggregator
database.default.username = your_db_username
database.default.password = your_db_password
database.default.DBDriver = MySQLi
```

**Database Setup** 
-Create a new database in MYSQL or MariaDB named 'newsaggregator' 
-Run the database migrations and seeders to set up the initial database schema and data: 
``` 
php spark migrate
php spark db:seed AdminSeeder
php spark db:seed NewsSeeder
```
**To access the admin functions, you'll need to log in with the admin credentials. The default admin credentials can be found in the AdminSeeder class. For security reasons, make sure to change these credentials after the initial setup.**

