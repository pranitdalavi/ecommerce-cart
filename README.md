Steps to setup the proejct :

=> Clone the proejct(You can use any method as per your convenience to clone the project) : "git clone git@github.com:pranitdalavi/ecommerce-cart.git"

=> In this project I have attached .env file from my side, so you can edit in that .env file as per your database credentials and mail credentials

=> Run command, "composer install"

=> Run command, "npm install"

=> Run command, "php artisan migrate"

=> Run command, "php artisan db:seed"

=> Run command, "php artisan serve"

=> Run command, "npm run dev"

=> In your browser run, "http://127.0.0.1:8000" OR application url which you have set in .env file

=> If you are checking on local then need to run "php artisan queue:work" and "php artisan schedule:work"

=> If you want to check sales report email, then need to change in console.php file. Just copy paste below code and comment existing code there.

Copy paste this code :   app(Schedule::class)
                            ->job(new DailySalesReportJob)
                            ->everyFiveSeconds();


=> Login Credentials :
1) Test user :
Username - test@ecommerce.com        
Password - password

2) Admin user :
Username - admin@ecommerce.com     
Password - password