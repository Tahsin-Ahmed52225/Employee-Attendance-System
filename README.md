# Employee Attendance System
## About This Project:
###### Technologies  Used:  <br>
**Frontend:** HTM,CSS,Bootstrap,JS,Jquery<br>
**Backend:** Laravel 7.1<br><br>
This is a Employee Attendance System. I have created two user panal/Role <br>
    1.Admin <br>
    2.Employee <br>

###### Admin Panel:  <br>
- Admin can create,update,delete any member and member can access their profile with those credentials 
- Admin can see each member  profile , and total overview of there attendance profile
- Admin can see all the member daily work update
- Admin can see who checked in , checked out , on leave , on home office on a daily basic 
- Admin can approve or reject any leave and home office request 
- Admin can add delete office holiday 
- Admin can change office start time , end time and total working hour 
###### Employee Panel:  <br>
- Employee can update their profile 
- Employee can request for leave , home office 
- Employee can check in and check out and add daily update
- Employee can update daily update

######  System Automation:  <br>
- System automatically add label ( Late , Full day , Half day , Home Office ) after check out based on office start and end time 
- System only late one check in per day 
- System don't allow to check if a employee is in leave or Office is in holiday 
- System automatically checkes out all the employee after a time and add a adsent list based to leave and home office list ( With a CRON JOB )







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
***Note*** : Set up a cron job 

    php artisan schedule:run 
    


