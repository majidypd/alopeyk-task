# alopeyk-task
 created by Majid Yousefi 
 please follow this steps:
 - First of all pull the project
 - run composer update to download all dependecies packages
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
 
Summary:

Each section of my code has their own comments for better understanding.
but in brief explanation:
I use my own oauth algorithm which for this task, i used a simple one.
i used Firebase\JWT\JWT package for create JWT-Token and put the user-id , expire-time and all of user roles as an array inside payload section of JWT-token.
when user send request to my APIs in authenticate middleware  i decode the JWT-token and recive all roles of the owner of token and check with access role policy of current request .if TRUE then request will continue.i ommited extra query for receiving roles of user because  performance reasons and add roles in payload section of JWT-Token.i Also ignored Custom Guards for simplicity.






