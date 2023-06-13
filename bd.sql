/****** CREATION DE LA BASE DE DONNEES *******/

DROP DATABASE chatyamo ;
CREATE DATABASE IF NOT EXISTS chatyamo ;
USE chatyamo ;

/***** CREATION DE LA TABLE DES MEMBRES *************/

CREATE TABLE membres(
id INT NOT NULL AUTO_INCREMENT,
pseudo VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
photo VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
email VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
motdepasse TEXT COLLATE utf8_unicode_ci NOT NULL,
dateinscription TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT PRIMARY KEY(id))
ENGINE = INNODB ;



/********  CREATION DE LA TABLE DES DISCUSSION  *****/


CREATE TABLE IF NOT EXISTS discussion(
iddiscussion INT NOT NULL AUTO_INCREMENT,
pseudomembre VARCHAR(100) NOT NULL,
photomembre VARCHAR(200) NOT NULL,
messagemembre TEXT NOT NULL,
datemessage TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT PRIMARY KEY(iddiscussion))
ENGINE = INNODB ;
