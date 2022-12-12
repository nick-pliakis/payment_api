# Payments API

A very simple implementation of a Payments API utilizing two PSPs.

The API is implemented in PHP, with a MySQL database for storing the merchant information.

The API and the database have been implemented as docker containers.

There is a single route that creates the payments, and is accessible through the following endpoint:
```
POST /payment/pay
```
With a JSON body with the following format:
```
{
	"amount": 400,	
  "currency": "EUR",
	"description": "Test description here",
	"card": {
		"number": "4242424242424242",
		"expiry_month": 5,
		"expiry_year": 27,
		"cvc": 999,
		"name": "TEST NAME",
		"address_line1": "test address 1",
		"address_city": "Test city",
		"address_postcode": "55443",
		"address_state": "absolute",
		"address_country": "test country"
	}
}
```
A basic authentication of the request has been implemented with JWT. Please note that, as this project only models the payment process, a register/login flow has not been implemented. Default JWT tokens can be provided if required.

## Installation instructions
1. Navigate to a folder of your choice and clone the project there:
```
git clone https://github.com/nick-pliakis/payments.git .
```
2. Navigate to the folder ```backend```. Create an ```.env``` file by copying the existing ```.env.example``` file
```
cp .env.example .env
```
Populate the  fields with the appropriate values. Please note that the values pertaining to the database credentials must be the same as the corresponding values in the ```stack``` folder (see below)

3. Navigate to the folder ```stack```. Create an ```.env``` file by copying the existing ```.env.example``` file
```
cp .env.example .env
```
Populate the fields with the appropriate values. Please note that the values pertaining to the database credentials must be the same as the corresponding values in the ```backend``` folder (see above)
4. While in the folder ```stack```, build the application stack with ```docker-compose```:
```
docker-compose up -d
```
5. Create the database, database user and user permissions, along with the Merchants table and three test merchant accounts by executing the scripts found in the ```mysqldb.sql``` file. The default user password has been left empty for security purposes. You should change the ```IDENTIFIED BY ''``` directive by replacing the empty string with the MySQL password you put in the ```.env``` files above.

6. Enter the ```app``` container and install dependencies with Composer:
```
docker exec -it app bash
composer install
```
6. The app should now be up and running. 
 
You can navigate to ```http://localhost:9011``` to use the app's functionalities.
