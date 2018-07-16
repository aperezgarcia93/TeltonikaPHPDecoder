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

- Fill your config.php with your information (database credentials, host, ip...)

**NOT FINISHED YET**
