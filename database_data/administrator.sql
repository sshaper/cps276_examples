########################################
# MySQL Crash Course
# http://www.forta.com/books/0672327120/
# Example table creation scripts
########################################

CREATE DATABASE IF NOT EXISTS administrator;

USE administrator;


########################
# Create admin table
########################
CREATE TABLE admin
(
  name      char(255)    NOT NULL,
  password  char(255)    NOT NULL
)
