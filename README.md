# Teltonika GPS PHP Decoder

This is a PHP application to easy decode the GPS information received from Teltonika devices.
This project is made to satisfy FMXXXX Protocols of Teltonika explained here:
http://bahpav.com/assets/uploadsp/doc/FMXXXX_Protocols_v2.10.pdf

This application provides some tools:
1. PHP TCP socket server in which you can receive the data sent by the teltonika device. 
2. Data parser to turn binary data received from the device into a view-friendly way.
3. Database mechanism to save that information into your database.

# Dependencies

- ReactPHP: https://reactphp.org/
- Medoo: https://medoo.in

# How to use

- You need to configure your teltonika device to point to your host/ip with TCP protocol in the GPS settings section.

- Open TCP port you will use in your network.

- Fill your config.php with your information (database credentials, host, ip...)

Create new php file (eg: run.php) and paste this code:
```php
/*Initialize the server and it will start getting data from device, 
parsing it and storing it into the database
*/
$server = new SocketServer(Conf::host, Conf::port);
$server->runServer();
```
Execute that php file:
```shell
php run.php
```

Server will start getting data from device.

## To do:

- [X] <del>Error with longitude (Maybe parsing or related to encoding with bytes?)</del> (FIXED)

