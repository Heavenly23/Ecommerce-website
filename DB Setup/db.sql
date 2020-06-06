DROP DATABASE IF EXISTS mb;

CREATE DATABASE mb;

GRANT ALL PRIVILEGES ON mb.* to grader@localhost IDENTIFIED BY 'allowme';

USE mb;

CREATE TABLE Users (
       userID INT,
       name CHAR(30),
       email CHAR(20),
       password CHAR(18),
       bankAccountNo INT(12),
       userType CHAR(6),
       PRIMARY KEY(userID)
       );

CREATE TABLE Buyers (
       userID INT,
       cardID INT NOT NULL,
       cardType CHAR(10),
       PRIMARY KEY(userID),
       FOREIGN KEY(userID) REFERENCES Users(userID) ON DELETE CASCADE,
       UNIQUE (cardID)
       );

CREATE TABLE Cards (
       cardType CHAR(10),
       discountRate INT,
       PRIMARY KEY(cardType)
       );
       
CREATE TABLE Sellers (
       userID INT,
       ssn INT NOT NULL,
       phone INT,
       PRIMARY KEY(userID),
       FOREIGN KEY(userID) REFERENCES Users(userID) on DELETE CASCADE,
       UNIQUE (ssn)
       );

CREATE TABLE Items (
       productID INT,
       name CHAR(20),
       price INT,
       category CHAR(20),
       description CHAR(255),
       url CHAR(255),
       PRIMARY KEY(productID)
       );

CREATE TABLE Tax (
       category CHAR(20),
       rate INT,
       PRIMARY KEY(category)
       );

CREATE TABLE Sells (
       userID INT,
       productID INT,
       qty INT,
       country CHAR(50),
       zipCode INT,
       street CHAR(255),       
       PRIMARY KEY(userID, productID),
       FOREIGN KEY(userID) REFERENCES Users(userID) ON DELETE CASCADE,
       FOREIGN KEY(productID) REFERENCES Items(productID) ON DELETE CASCADE
       );

CREATE TABLE ZipCode (
       zipCode INT,
       country CHAR(50),
       city CHAR (50),
       state CHAR(50),
       PRIMARY KEY(zipCode,country)
       );

CREATE TABLE isAllowed (
       country CHAR(50),
       isAllowed BOOLEAN,
       PRIMARY KEY(country)
       );

CREATE TABLE Orders (
       orderID INT,
       isCompleted BOOLEAN,
       isShipped BOOLEAN,
       isDelivered BOOLEAN,
       PRIMARY KEY(orderID)
       );

CREATE TABLE Cart (
       orderID INT,
       productID INT,
       qty INT,
       price INT,
       PRIMARY KEY(orderID, productID),
       FOREIGN KEY(orderID) REFERENCES Orders(orderID) ON DELETE CASCADE,
       FOREIGN KEY(productID) REFERENCES Items(productID) ON DELETE CASCADE
       );

CREATE TABLE Places (
       userID INT,
       orderID INT,
       country CHAR(50),
       zipCode INT,
       street CHAR(255),
       price INT,
       PRIMARY KEY(userID, orderID),
       FOREIGN KEY(orderID) REFERENCES Orders(orderID) ON DELETE CASCADE,
       FOREIGN KEY(userID) REFERENCES Users(userID) ON DELETE CASCADE
       );
       
