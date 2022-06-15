<!--Make this into a nice input form!-->
<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation!</title>
    </head>
    <body>
        <?php
            // This is where all of the database related operations will go
            //Get Heroku ClearDB connection information
            $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $cleardb_server = $cleardb_url["host"];
            $cleardb_username = $cleardb_url["user"];
            $cleardb_password = $cleardb_url["pass"];
            $cleardb_db = substr($cleardb_url["path"],1);
            $active_group = 'default';
            $query_builder = TRUE;
            // Connect to DB
            $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


            $title = $_REQUEST['title-input'];
            $album_cover = $_REQUEST['album_cover-input'];
            $rating = $_REQUEST['rating-input'];
            $genre = $_REQUEST['genre-input'];
            $thoughts = $_REQUEST['thoughts-input'];


            // Issue with the punctuation, need to figure out a workaround for that!
            $query = "INSERT INTO reviews VALUES(\"$title\", \"$album_cover\", \"$rating\", \"$genre\", \"$thoughts\")";

            if ($conn->query($query) === TRUE){
                echo "Success!" . "<br>";
            } else {
                echo "It did not work!";
            }

            $conn->close();
        ?>
    </body>
</html>
