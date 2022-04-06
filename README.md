# ![Employee Attendance System]

#About This Project


## Installation



Clone the repository

    git clone git@github.com:Tahsin-Ahmed52225/Employee-Attendance-System.git

Switch to the repo folder

    cd Employee-Attendance-System 

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


## Database seeding

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    


