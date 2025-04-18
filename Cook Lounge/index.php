<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: 'Lora', serif; /* Elegant and professional font */
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Soft pearl white */
            color: #333333; /* Dark slate gray */
        }
        header {
            background-color: #2C3E50; /* Updated background color */
            border-bottom: 3px solid #D4AF37; /* Royal gold accent */
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
        }
        .navbar img {
            height: auto;
            width: 100px; /* Updated width */
            margin-right: 5px; /* Added margin */
        }
        .navbar-items {
            flex-grow: 1; /* Allow items to take space */
            display: flex;
            justify-content: center; /* Center menu */
        }
        .navbar-items ul {
            display: flex;
            list-style: none;
        }
        .navbar-items ul li {
            margin: 0 15px;
        }
        .navbar-items ul li a {
            text-decoration: none;
            color: #ffffff; /* Updated text color */
            font-weight: bold;
            transition: 0.3s;
        }
        .navbar-items ul li a:hover {
            color: #D4AF37; /* Updated hover color */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Add text shadow on hover */
        }
        section {
            transition: transform 0.3s; /* Smooth transition for scaling */
        }
        section:hover {
            transform: scale(1.02); /* Scale up on hover */
        }
        img {
            transition: transform 0.3s; /* Smooth transition for images */
        }
        img:hover {
            transform: scale(1.05); /* Scale up images on hover */
        }

        .icons img {
            width: 30px;
            cursor: pointer;
        }
        main {
            padding: 40px;
            text-align: center;
        }
        section {
            background: #FFFFFF; /* Pure white */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 20px auto;
        }
        h2 {
            font-size: 28px;
            color: #2C3E50;
        }
        footer {
            background-color: #1B1B1B; /* Graphite gray */
            color: white;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="cook lounge logo2.png" alt="Logo" style="height: auto; width: 100px; margin-right: 5px;"> <!-- Updated logo -->

            <div class="navbar-items">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="recipe.php">RECIPES</a></li>
                    <li><a href="admin_login.php">USER</a></li>
                </ul>
            </div>
    </header>

    <main>
        <section>
            <h2>Welcome to Cook Lounge</h2>
            <p>Discover a world of flavors at Cook Lounge! From traditional Malaysian dishes to international delights, we bring you easy-to-follow recipes that make cooking a joy. Whether you're a beginner or a seasoned chef, let's create delicious memories together!</p>
        </section>
        <section>
            <h2>Taste with your eyes!</h2>
            <p>Explore our vibrant gallery of mouth-watering dishes and get inspired to cook something amazing today!</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="text-align: center;">
                        <img src="cucur index.png" alt="Cucur" style="width: 100%; max-width: 200px; border-radius: 10px;">
                    </td>
                    <td style="text-align: center;">
                        <img src="pancake index.png" alt="Pancake" style="width: 100%; max-width: 200px; border-radius: 10px;">
                    </td>
                    <td style="text-align: center;">
                        <img src="nasi lemak index.png" alt="Nasi Lemak" style="width: 100%; max-width: 200px; border-radius: 10px;">
                    </td>
                    <td style="text-align: center;">
                        <img src="pelita index.png" alt="Pelita" style="width: 100%; max-width: 200px; border-radius: 10px;">
                    </td>
                </tr>
            </table>
        </section>
    </main>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>
</body>
</html>
