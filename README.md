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
'''bash 
git clone https://github.com/yourusername/NewsAggregator.git
cd NewsAggregator

###Install Dependencies
'''bash 
composer install 

###Environment Setup
'''bash 
cp env .env

###Edit the env file to set your database credentials ant the base URL for the applications 
'''bash 
app.baseURL = 'http://localhost/NewsAggregator'
database.default.hostname = localhost
database.default.database = newsaggregator
database.default.username = your_db_username
database.default.password = your_db_password
database.default.DBDriver = MySQLi

###Database Setup 
# Create a new database in MYSQL or MariaDB named 'newsaggregator' 
#Run the database migrations and seeders to set up the initial database schema and data: 
'''bash 
php spark migrate
php spark db:seed AdminSeeder
php spark db:seed NewsSeeder

###Running the Application 
#Start your local server (e.g., XAMPP).
#Ensure your web server points to the public directory of the project.
#Open your web browser and navigate to http://localhost/NewsAggregator.



###Important Change with index.php

index.php is no longer in the root of the project! It has been moved inside the public folder, for better security and separation of components.

This means that you should configure your web server to "point" to your project's public folder, and not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter public/..., as the rest of your logic and the framework are exposed.

Please read the user guide for a better explanation of how CI4 works!

###Repository Management

We use GitHub issues, in our main repository, to track BUGS and to track approved DEVELOPMENT work packages. We use our forum to provide SUPPORT and to discuss FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script. Problems with it can be raised on our forum, or as issues in the main repository.

###Server Requirements
PHP version 8.1 or higher is required, with the following extensions installed:

intl
mbstring
Warning:
The end of life date for PHP 7.4 was November 28, 2022. The end of life date for PHP 8.0 was November 26, 2023. If you are still using PHP 7.4 or 8.0, you should upgrade immediately. The end of life date for PHP 8.1 will be November 25, 2024.

Additionally, make sure that the following extensions are enabled in your PHP:

json (enabled by default - don't turn it off)
mysqlnd if you plan to use MySQL
libcurl if you plan to use the HTTP\CURLRequest library


###Usage Instructions
Clone the repository.
Run composer install to install all dependencies.
Copy the env file to .env and update your environment settings.
Create a database named newsaggregator and update the .env file with your database credentials.
Run the migrations and seeders to set up your database:
'''bash 
php spark migrate
php spark db:seed AdminSeeder
php spark db:seed NewsSeeder

Start your server and point to the public directory.
Access the application at http://localhost/NewsAggregator.

###Admin Credentials
After running the seeders, you can log in as an admin with the following credentials:

Username: admin
Password: password123

###Security Considerations
Make sure to never expose your .env file or any sensitive configuration files.
Regularly update your dependencies.
Review the CodeIgniter security guide for best practices.

###Contribution Guidelines
If you would like to contribute to this project, please follow the standard GitHub workflow for forking, branching, and pull requests.

Fork the repository.
Create a new branch: git checkout -b my-feature-branch.
Make your changes and commit them: git commit -m 'Add some feature'.
Push to the branch: git push origin my-feature-branch.
Submit a pull request.

License
This project is licensed under the MIT License - see the LICENSE file for details.


