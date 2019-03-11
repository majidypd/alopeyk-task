# alopeyk-task
 created by Majid Yousefi 
 please follow this steps:
 - First of all pull the project
 - run composer update to download all dependencies packages
 - create db schema with any name you like and add it to .env file
 - run php artisan migrate
 - run php artisan db:seed
 Ready to go!
 
There is few files you have to see: 
- database\migrations 
- database\seeds
Controllers:
- OrderController
- OrderController
- ProductController
- UserController
Models : 
- App\Http\Order.php
- App\Http\User.php
- App\Http\Product.php
- App\Http\Role.php
Middleware:
 middleware\Authenticate.php
 
Breif:

Each section of my code has their own comments for better understanding.
but in brief explanation:
I use my own oauth algorithm which for this task, i used a simple one.
i used Firebase\JWT\JWT package for create JWT-Token and put the user-id , expire-time and all of user roles as an array inside payload section of JWT-token.
when user send request to my APIs in authenticate middleware  i decode the JWT-token and receive all roles of the owner of token and check with access role policy of current request .if TRUE then request will continue.i ommited extra query for receiving roles of user because  performance reasons and add roles in payload section of JWT-Token.i Also ignored Custom Guards for simplicity.


Usage:
Opent Postman or any app or method you like to requst.
the first request must be a auth request so send a post request to this address:
YourHOST/public/api/authenticate
with this parameters:
email:admin@test
password: secret
if you send correct info you will receive a jwt-token . at the very first request you must request with "admin" email and password so the first token is for a admin. you can see admin email and password in database\seeds.
so now you can add a new seller .
send a request to YourHOST/public/api/user/store/2
the "2" at the end of url is role of this user wich in this case is a seller or store . you can add a customer with number 3 .
the parameter you need  is :
 - token (which gain from previous step)
 - name  (name of seller or customer)
 - email
 - password
 - lat (please fill with correct Latitude if tou want to test in next step)
 - lng
 - address
 if wvwery thing goes fine




