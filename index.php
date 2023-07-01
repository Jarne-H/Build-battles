<?php
//error handeling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'src/hidden/php/bootstrap.php';
require_once 'src/hidden/php/db.php';


//connect to database and start session src/hidden/config/config.php
require_once 'src/hidden/config/config.php';

//make $link for connection to database using db.php
$link = DB::getInstance();
//check connection
if($link === false){
    die("ERROR: Could not connect. CONTACT THE ADMIN! ERROR:" . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The buildbattle community</title>
    <link rel="shortcut icon" href="src/public/img/favicon/server-icon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="src/public/img/favicon/server-icon.png">
    <meta name="description" content="We're stiving to become the number 1 builders and buildbattle community! If you're interested in participating, consider joining our discord server!">
    <meta name="keywords" content="buildbattle, buildbattles, build, battles, minecraft, minecraft buildbattle, minecraft buildbattles, minecraft build, minecraft battles, minecraft buildbattles, minecraft buildbattle, minecraft buildbattle theme, minecraft buildbattles theme, minecraft build theme, minecraft battles theme, minecraft buildbattles theme, minecraft buildbattle theme, minecraft buildbattle theme, minecraft buildbattles theme, minecraft build theme, minecraft battles theme, minecraft buildbattles theme, minecraft buildbattle theme, buildbattle theme, buildbattles theme, build theme, battles theme, buildbattles theme, buildbattle theme, buildbattle theme, buildbattles theme, build theme, battles theme, buildbattles theme, buildbattle theme">
    <meta name="author" content="Duckstyle">
    <link rel="stylesheet" href="src/hidden/css/fonts.css">
    <link rel="stylesheet" href="src/public/css/style.css">
</head>
<body>
    <header>
        <section id="slideshow">
            <nav>
                <div class="nav__sign"><a href="builders.html">Who are we?</a></div>
                <div class="nav__sign"><a href="#">Previous<br>winners</a></div>
            </nav>
            <div id="themeSign" href="#buildThemeScroll">
                <section>
                    <h3 id="themeSign__title">Current Theme:</h3>
                    <p class="themeSign__description" id="longText">Castle in style/<br>shape of any mob</p>
                    <p class="themeSign__description" id="smallText">Click here!</p>
                </section>
            </div>
            <div id="buildbattle__title">
                <h1>buildbattles</h1>
                <a class="discord__sign" target=”_blank” href="https://discord.gg/QpT383Ygq9">
                    <img src="src/public/img/discord_sign.webp" alt="link to the community discord">
                </a>
            </div>
        </section>
    </header>
    <main>
        <section id="cave">
                <div id="buildThemeScroll">
                    <h2 class="buildbattle-title">Build Theme</h2>
                    <p >
                        <?php
$current_time = date("Y-m-d H:i:s");

// create a PDO instance
$dbConfig = parse_ini_file(__DIR__ . "/src/hidden/config/config.ini");
$dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'];
$pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);

// check if there is a theme used since the first day 12:00 of the current month
$sql = "SELECT theme_name, theme, last_used FROM themes WHERE last_used > DATE_SUB(DATE_SUB(NOW(), INTERVAL DAY(NOW())-1 DAY), INTERVAL 12 HOUR) ORDER BY last_used DESC LIMIT 1";
$result = $pdo->query($sql);

// check if there are any results
if ($result->rowCount() > 0) {
    // output data of each row
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // get theme_name, theme, and last_used from table 'themes'
        $theme_name = $row["theme_name"];
        $theme = $row["theme"];
        $last_used = $row["last_used"];

        echo $theme;
    }
} else {
    // get random theme from table 'themes' which hasn't been used in 3 months
    $sql = "SELECT theme_name, theme, last_used FROM themes WHERE last_used < DATE_SUB(NOW(), INTERVAL 3 MONTH) ORDER BY RAND() LIMIT 1";
    $result = $pdo->query($sql);

    // check if there are any results
    if ($result->rowCount() > 0) {
        // output data of each row
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // get theme_name, theme, and last_used from table 'themes'
            $theme_name = $row["theme_name"];
            $theme = $row["theme"];
            $last_used = $row["last_used"];

            echo $theme;

            // update last_used in table 'themes'
            $sql = "UPDATE themes SET last_used = :current_time WHERE theme_name = :theme_name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':current_time', $current_time);
            $stmt->bindParam(':theme_name', $theme_name);
            if ($stmt->execute()) {
                // echo "Records were updated successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql.";
            }
        }
    } else {
        echo "0 results";
    }
}

// close connection
$pdo = null;
                        ?>
                        <br><br>
                        If you have any questions, hop over to our Discord!
                    </p>
                    <a href="https://discord.gg/QpT383Ygq9" target=”_blank” class="button-discord">
                        <img src="src/public/img/icon_clyde_white_RGB.svg" alt="discord logo">
                        Join now!
                    </a>
                </div>
        </section>
        
        <section id="nether">
            <div id="buildThemeScroll">
                <h2 class="buildbattle-title">How to join</h2>
                <p>
                    If you want to participate in a more competitive way or simply want to see what other people have created, feel free to join our Discord.
                    Being a part of our Discord community allows you to engage with like-minded individuals and explore various builds.
                    Whether you're interested in showcasing your skills or simply enjoying the creative atmosphere. You are more than welcome!
                    Just click the button below.
                </p>
                <a href="https://discord.gg/QpT383Ygq9" target=”_blank” class="button-discord">
                    <img src="src/public/img/icon_clyde_white_RGB.svg" alt="discord logo">
                    Join now!
                </a>
            </div>
        </section>
    </main>
    <footer>
        <a id="copyright" href="https://www.duckstyle-design.be">Copyright Duckstyle 2023</a>
    </footer>
</body>
<!--
<script src="src/js/buildslideshow.js"></script>
-->
</html>