-- Create the database
CREATE DATABASE IF NOT EXISTS TESTING;
USE TESTING;

-- Create the table with 32 VARCHAR columns
DROP TABLE IF EXISTS ENTRIES;
CREATE TABLE IF NOT EXISTS ENTRIES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `SUBMISSION DATE` VARCHAR(255),
    `PLAN` VARCHAR(255),
    `UPLOADED FILE` VARCHAR(255),
    `PRIME PLAN` VARCHAR(255),
    `CARD TYPE` VARCHAR(255),
    `AVAILMENT DATE` VARCHAR(255),
    `SURNAME` VARCHAR(255),
    `EFFECTIVE DATE` VARCHAR(255),
    `CARDNUMBER` VARCHAR(255),
    `SO` VARCHAR(255),
    `BUH` VARCHAR(255),
    `BH` VARCHAR(255),
    `SD` VARCHAR(255),
    `REFERER OR HANDLING AGENT` VARCHAR(255),
    `DATA PRIVACY CLAUSE` VARCHAR(255),
    `ASSIGNED BPIA EMPLOYEE` VARCHAR(255),
    `COVERAGE CLAUSE` VARCHAR(255),
    `MOBILE NUMBER` VARCHAR(255),
    `EMAIL ADDRESS` VARCHAR(255),
    `BENEFICIARY FULL NAME` VARCHAR(255),
    `BENEFICIARY RELATIONSHIP` VARCHAR(255),
    `BENEFICIARY BIRTHDATE` VARCHAR(255),
    `COMPLETE ADDRESS` VARCHAR(255),
    `GIVE NAME` VARCHAR(255),
    `MIDDLE NAME` VARCHAR(255),
    `BITHDATE` VARCHAR(255),
    `AGE` VARCHAR(255),
    `STUDENT PLAN` VARCHAR(255),
    `MODE OF PAYMENT` VARCHAR(255),
    `SUBMISSION ID` VARCHAR(255),
    `SUBMISSION IP` VARCHAR(255),
    `LAST UPDATE DATE` VARCHAR(255)
); 