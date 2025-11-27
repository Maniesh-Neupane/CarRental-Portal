CarRental-Portal
================

A complete Car Rental Portal application.

Frontend: HTML, CSS, JavaScript
Backend: PHP, MySQL

Live Demo: https://carbca.infy.uk

---

Screenshots
-----------

Homepage:
https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/index1.png?raw=true

Booking Page:
https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/index2.png?raw=true

---

Features
--------

- Online car booking
- Admin dashboard for managing cars, bookings, and users
- Easy local and Docker deployment

---

A. Installation on Localhost (XAMPP/WAMP)
-----------------------------------------

1. Install XAMPP or WAMP

2. Download the Project
   git clone https://github.com/Maniesh-Neupane/CarRental-Portal.git

3. Move Project Files
   Copy the files to the `htdocs` folder inside your XAMPP/WAMP installation (e.g., xampp/htdocs/).

4. Start Apache and MySQL in XAMPP/WAMP.

5. Setup Database
   - Open http://localhost/phpmyadmin
   - Create a new database: `carproject`
   - Import `carproject.sql` into this database.

6. Run the Application
   Open your browser: http://localhost/carrental

7. Admin Dashboard
   - Login URL: http://localhost/carrental/adminlogin.php
   - Username: Maniesh
   - Password: Maniesh123

---

B. Docker Installation Guide
----------------------------

Step 1: Pull the Docker Image
docker pull pwn4arn/carrental-portal-app:v1

- Downloads the pre-configured CarRental-Portal image from Docker Hub.

Step 2: Run the Docker Container
docker run -p 8080:80 pwn4arn/carrental-portal-app:v1

- `-p 8080:80` maps container port 80 to local port 8080.
- Open your browser at http://localhost:8080 to access the application.
- If port 8080 is busy, replace it with another port, e.g., `-p 3000:80`.


---

Admin Dashboard Screenshots
---------------------------

Add Car:
https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/addcar.png?raw=true

Booking Requests:
https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/bookingreq.png?raw=true

User Management:
https://github.com/Maniesh-Neupane/CarRental-Portal/blob/master/adminuser.png?raw=true

---

Advantages of Using Docker
--------------------------

- No need to manually install or configure PHP, MySQL, or Apache.
- Works the same across Windows, macOS, and Linux.
- Easy to start, stop, or remove containers without affecting your system.
- Quick deployment and portable setup.

---

Your Car Rental Portal is now ready to use!
