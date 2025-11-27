 It is created using HTML ,CSS , JAVASCRIPT on Frontend and on Backend PHP and MySQL are used.


This Project is Deployed Live on   https://carbca.infy.uk

![image alt](https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/index1.png?raw=true)

![image alt](https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/index2.png?raw=true)


Installation Process

1. Install XAMPP or WAMP
   
2. Download the Project
   - Download the zip file of the project or clone the repository using the following command:
   - 
     git clone https://github.com/Maniesh-Neupane/CarRental-Portal.git

3. Move the Project Files
   - Copy or move the project files into the htdocs folder inside the XAMPP installation directory ( e.g., xampp/htdocs/ ).

4. Start Apache and MySQL
   - Open XAMPP and start the Apache and MySQL 

5. Setup the Database
   - Open your browser and go to http://localhost/phpmyadmin.
   - Create a new database named carproject.
   - Import the carproject.sql file into the carproject database.

6. Run the Application
   - Open your browser and go to http://localhost/carrental to access the project.

7. Admin Dashboard
   - Credentials:
     - Username: Maniesh
     - Password: Maniesh123
   - Admin Login Path:
     http://localhost/carrental/adminlogin.php

Your Car Rental Portal is now ready to use!


B. Docker Installation Guide

Step 1: Pull the Docker Image

    docker pull pwn4arn/carrental-portal-app:v1
 Download the pre-configured CarRental-Portal Docker image from Docker Hub:


Step 2: Run the Docker Container
    docker run -p 8080:80 pwn4arn/carrental-portal-app:v1
 Start the application by running the container:

   -p 8080:80 maps port 80 inside the container (the web server port) to port 8080 on your computer.

   Open your browser and visit http://localhost:8080

   If port 8080 is already in use, you can use another port, e.g., -p 3000:80.




                                    
Admin Dashboard
![image alt](https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/addcar.png?raw=true)

![image alt](https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/bookingreq.png?raw=true)

![image alt](https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/adminuser.png?raw=true)




 

    
