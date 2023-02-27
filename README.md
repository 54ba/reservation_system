<h1 align="center">
Ticketposs
</h1>

<div align="center">

> Cinema tickets POS (poin of sale) running on NGINX/https using VueJS, Laravel and docker 

</div>

---	


### Progress


- Upgraded to MYSQL8 - Installed Redis 
- Modified Ngix config and SSL self-signed cert for dev - Added config forLoadBalancer
- Modified seeds with related records data using Faker and importing ```database/movies.json```
- Refactored the project's structure
- PHPUNIT test cases

### In progress
<ul>
    <li>Finish seeders</li>
  <li>Complete UNIT testing </li>
  <li>redesign UI - Vue and the UX </li>
  <li>Redis cache</li>
  <li>implement simple Authentication with just a password and variable names(sessions)</li>
</ol>

---	
## 1. Getting Started




### Using Docker

##### 1st time only
```sh
docker-compose up -d --build 
```

##### 1. Installing Dependencies 

```sh
docker-compose up -d
docker-compose run composer install
docker-compose run npm install
```
##### 2. Building Assets For Development

```sh
docker-compose run npm run dev
```

##### 3. Migrate and Seed MYSQL DB with Laravel CLI

```sh
docker-compose run artisan migrate
docker-compose run artisan db:seed
```

---	
### Manual Without Docker

##### 1. Create .env on linux 
```
cp -a .env.example .env 
```

##### 2. Installing Dependencies
```
composer install
npm install
```
##### 3. Migrating and Seeding MYSQL DB

```
php artisan migrate
php artisan db:seed
```
##### 4. Running PHP Server
```
php artisan serve
```
##### 5. Building Assets For Development

```
npm run dev
```
##### 6. Building Assets For Production

```
npm run prod
```

---	
## 2. phpmyadmin will be on:

``` 
https://localhost:8080/ 
```
### The default mysql and phpmyadmin creds are :
<div align="center">
<p><strong>User: </strong>  <em>root</em></p>
<p><strong>Pass: </strong>  <em>secret</em></p>
</div>

---	

## 3. The VueJS UI will be on:

```
http://localhost:8888/ 
```
---	
## 4. The Secure VueJS UI will be on:

``` 
https://localhost:4433/
```

---	
## 5. Then see the json returned from the movies API route here:

``` 
http://localhost:8888/api/receptionist/movies
```

---	
## Bundled [VueDevTools](https://chrome.google.com/webstore/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd) And [LaravelDevBar](http://phpdebugbar.com/docs/)


---	

## In case you need to regenerate SSL keys 

Open the command line and run these commands inside the ```services/nginx/ssl``` folder to generate a self signed certificate:


``` openssl req -new -newkey rsa:2048 -x509 -sha512 -days 365 -nodes -out nginx.crt -keyout nginx.key ```


``` openssl dhparam -out dhparam.pem 2048 ```


--- 