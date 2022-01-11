# student-management

1. Clone the git repository
    git clone https://github.com/nameisalvi/student-management.git
2. Update the composer to get all the packages
    composer update
3. Create the database and update .env file in the root folder
    DB_DATABASE, DB_USERNAME, DB_PASSWORD
4. Run php artisan migrate to migrate all the tables in the database
5. Run php artisan serve to deployment
6. /student url for the listing of students
   /mark url for listing of marks