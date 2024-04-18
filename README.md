
# Flight Search and Display System
This system allows users to search for flights based on departure airport, destination airport, and departure date. After performing a search, the system retrieves flight information from an external API, stores the results in a database, and displays the results to the user.

### Technologies Used
- PHP 8
- MySQL
- JavaScript (AJAX)
- HTML/CSS


Installation
Clone the repository:

Installation
Clone the repository:

git clone https://github.com/your-repo/flight-search.git


### Navigate to the project directory:
cd flight-search


### install dependencies:
composer install


Import the SQL schema located in interview.sql into your MySQL database


### Configuration

### Update Database Connection Details

Update the database connection details in `config.php`:

```php
return [
    'host' => 'your_database_host',
    'dbname' => 'your_database_name',
    'username' => 'your_database_username',
    'password' => 'your_database_password',
];

