<?php
/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 18/07/2018
 * Time: 13:17
 */

CREATE SCHEMA `teltonika_gps` ;

CREATE TABLE `teltonika_gps`.`gps_data_devices` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imei` VARCHAR(15) NULL,
  `longitude` DOUBLE NULL,
  `latitude` DOUBLE NULL,
  `angle` INT NULL,
  `altitude` INT NULL,
  `satellites` INT NULL,
  `speed` INT NULL,
  `datetime` DATETIME NULL,
  PRIMARY KEY (`id`));

