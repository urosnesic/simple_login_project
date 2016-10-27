# simple_login_project
The main purpose of this project was to create simple backend for connecting with databse to log in and sing up users, with rudimentary
admin capabilities.The goal also was for code to be portable enough that it could be pluged-in in other projects with very little 
modification. Later on, index page has been modified to look more like some part of bigger site, which might undermined original 
purpose of the project.

In this project, I used PHP for backend, vanila javascript for ajax and picture rotation in index page, jQuery for Login and Signup
form effects on index page and for clock in private_page and MySQL as database. Also, I used Bootstrap.

This is index.php with Signup selected:

<img src="https://cloud.githubusercontent.com/assets/22999740/19762520/982e050c-9c3a-11e6-8dfa-39419f87bbe2.png" />

<br />
This is private_page with user, who has admin privileges, loged in:

<img src="https://cloud.githubusercontent.com/assets/22999740/19762571/ca46210a-9c3a-11e6-9b8a-b5cc2a2e9a9e.png" />

<br />
This is admin page with some data shown:

<img src="https://cloud.githubusercontent.com/assets/22999740/19762610/f53f020a-9c3a-11e6-8965-3ebf5d00eb87.png" />

For now, only way for a user to become an admin is to be given admin privileges by another admin. 
You can log in with existing user that already has admin privileges:<br />
username: firstuser<br />
password: sifra123<br />
Database user and password are located in includes/init.php
