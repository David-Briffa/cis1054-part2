<?php
include_once "connectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bookingStyle.css" />
    <link rel="script" src="main.js" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@300;400;500;600&family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <title>Booking</title>
  </head>

  <body>
  <?php include "header.html"?>

    <div class="middle">
      <div class="divider"></div>
      <div class="divider"></div>

      <div class="bookingForm border blackBorder">
        <h2>MAKE YOUR RESERVATION!</h2>
        <div class="img"></div>
        <div class="content">
          <h3>Reservation</h3>
          <form class="formRow" action="" method="post">
            <input
              type="date"
              name="date"
              id="date"
              placeholder="Select Date"
              required
            />
            <input
              type="time"
              name="time"
              id="time"
              placeholder="Select Time"
              required
            />
          </form>

          <form class="formRow" action="" method="post">
            <input type="text" name="name" placeholder="Full Name" required />
            <input
              type="tel"
              name="number"
              placeholder="Phone Number"
              required
            />
          </form>

          <form class="formRow" action="" method="post">
            <input
              type="email"
              name="email"
              placeholder="Email Address"
              required
            />
            <input
              type="number"
              name="peopleNumber"
              id="peopleNumber"
              placeholder="Number of People"
              required
            />
          </form>

          <form class="formRow" action="./reservation.php">
            <input type="submit" value="Book Table Now!" />
          </form>
        </div>
      </div>

      <div class="divider"></div>
      <div class="divider"></div>
    </div>

    <?php include "footer.html"?>
  </body>
</html>
