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
       

INSERT INTO Users (userID, name, email, password, bankAccountNo, userType)
VALUES (1, 'John Apple', 'John.apple@gmail.com', '1234', 123456789, 'Buyer');
INSERT INTO Users (userID, name, email, password, bankAccountNo, userType)
VALUES (2, 'Steve Apple', 'mac@apple.com', '1234', 123457689, 'Seller');

INSERT INTO Buyers (userID, cardID, cardType)
VALUES (1, 1, 'Gold');

INSERT INTO Cards (cardType, discountRate)
VALUES ('Gold', 10);

INSERT INTO Sellers (userID, ssn, phone)
VALUES (2, 123123123, 0000000000);

INSERT INTO Items (productID, name, price, category, description)
VALUES (1, 'iPhone X', 700, 'Phone', 'Apple''s newest and fastest phone with great display and camera');

INSERT INTO Tax (category, rate)
VALUES ('Phone', 2.5);

INSERT INTO Sells (userID, productID, qty, country, zipCode, street)
VALUES (2, 1, 10, 'Korea', 0001, 'Suny Korea, Academic Building B, 11th Floor');

INSERT INTO ZipCode (zipCode, country, city, state)
VALUES (0001, 'Korea', 'Songod', 'Incheon');

INSERT INTO isAllowed (country, isAllowed)
VALUES ('Korea', true);
INSERT INTO isAllowed (country, isAllowed)
VALUES ('USA', false);
INSERT INTO isAllowed (country, isAllowed)
VALUES ('Japan', true);
INSERT INTO isAllowed (country, isAllowed)
VALUES ('China', true);
INSERT INTO isAllowed (country, isAllowed)
VALUES ('UK', false);
INSERT INTO isAllowed (country, isAllowed)
VALUES ('France', false);
