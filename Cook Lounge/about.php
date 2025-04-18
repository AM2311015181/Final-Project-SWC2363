<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Lora', serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            color: #333333;
        }
        header {
            background-color: #2C3E50;
            border-bottom: 3px solid #D4AF37;
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: center; /* Center the navbar */
            align-items: center;
            padding: 10px 20px;
        }
        .navbar img {
            height: 40px;
            margin-right: 20px; /* Add space between logo and links */
        }
        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar li {
            margin: 0 20px;
        }
        .navbar a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #D4AF37;
        }
        .hero {
            background: url('hero-image.jpg') no-repeat center/cover;
            color: #2C3E50;
            text-align: center;
            padding: 80px 20px;
        }
        .hero h1 {
            font-size: 3rem;
            margin: 0;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .section {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 20px auto;
            text-align: center;
        }
        .section h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #2C3E50;
        }
        .values {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 50px 20px;
        }
        .value-box {
            background: #FFF2D8;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-width: 250px;
        }
        .value-box h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }
        .cta {
            text-align: center;
            padding: 50px 20px;
            background: #E4C59E;
        }
        .cta h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        .cta button {
            background: #A45C40;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        .cta button:hover {
            background: #8D4A33;
        }
        footer {
            background-color: #1B1B1B;
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
            <img src="cook lounge logo2.png" alt="Logo">

            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="recipe.php">RECIPES</a></li>
                <li><a href="addrecipe.php">ADD RECIPE</a></li>
                <li><a href="admin_login.php">USER</a></li>
            </ul>
            
        </div>
    </header>

    <div class="hero">
        <h1>Welcome to Cook Lounge</h1>
        <p>Where Passion Meets the Plate</p>
    </div>

    <section class="section">
        <h2>Our Story</h2>
        <p>Cook Lounge was born out of a love for great food and a desire to make cooking accessible for everyone. 
           From beginners to seasoned chefs, our platform is a space to learn, share, and enjoy the art of cooking.</p>
    </section>

    <section class="values">
        <div class="value-box">
            <h3>🌱 Fresh Ingredients</h3>
            <p>We believe great food starts with quality ingredients.</p>
        </div>
        <div class="value-box">
            <h3>👨‍🍳 Passionate Community</h3>
            <p>A place where food lovers can connect and share.</p>
        </div>
        <div class="value-box">
            <h3>🍽️ Easy & Fun Cooking</h3>
            <p>Bringing joy to kitchens, one recipe at a time.</p>
        </div>
    </section>

    <section class="cta">
        <h2>Join Our Community</h2>
        <p>Stay updated with the latest recipes and cooking tips.</p>
        <button>Subscribe Now</button>
    </section>

    <footer>
        <p>© 2025 Cook Lounge</p>
    </footer>
</body>
</html>
