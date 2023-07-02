<?php
require_once 'db.php';

//make $link for connection to database using db.php
$link = DB::getInstance();
//check connection
if($link === false){
    die("ERROR: Could not connect. CONTACT THE ADMIN! ERROR:" . mysqli_connect_error());
}

class getTheme
{
    private $pdo;

    public function __construct()
    {
        // create a PDO instance
        $dbConfig = parse_ini_file(__DIR__ . "/../src/hidden/config/config.ini");
        $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'];
        $this->pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
    }

    public function getTheme()
    {
        $current_time = date("Y-m-d H:i:s");

        // check if there is a theme used since the first day 12:00 of the current month
        $sql = "SELECT theme_name, theme, last_used FROM themes WHERE last_used > DATE_SUB(DATE_SUB(NOW(), INTERVAL DAY(NOW())-1 DAY), INTERVAL 12 HOUR) ORDER BY last_used DESC LIMIT 1";
        $result = $this->pdo->query($sql);

        // check if there are any results
        if ($result->rowCount() > 0) {
            // output data of each row
            while ($theme = $result->fetch(PDO::FETCH_ASSOC)) {
                // get theme_name, theme, and last_used from table 'themes'
                return $theme;
            }
        } else {
            // get random theme from table 'themes' which hasn't been used in 3 months
            $sql = "SELECT theme_name, theme, last_used FROM themes WHERE last_used < DATE_SUB(NOW(), INTERVAL 3 MONTH) ORDER BY RAND() LIMIT 1";
            $result = $this->pdo->query($sql);

            // check if there are any results
            if ($result->rowCount() > 0) {
                // output data of each row
                while ($theme = $result->fetch(PDO::FETCH_ASSOC)) {
                    // get theme_name, theme, and last_used from table 'themes'

                    // update last_used in table 'themes'
                    $sql = "UPDATE themes SET last_used = :current_time WHERE theme_name = :theme_name";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':current_time', $theme["current_time"]);
                    $stmt->bindParam(':theme_name', $theme["theme_name"]);
                    if ($stmt->execute()) {
                        // echo "Records were updated successfully.";
                    } else {
                        echo "ERROR: Could not able to execute $sql.";
                    }
                    return $theme;
                }
            } else {
                echo "0 results";
            }
        }
    }

    public function __destruct()
    {
        // close connection
        $this->pdo = null;
    }
}
