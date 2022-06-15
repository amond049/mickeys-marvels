<!DOCTYPE html>
<html>
    <head>
        <!--Maybe add subscription functionality that will notify the user when a new review has been uploaded-->
        <!--What about a "What have I been listening to functionality" that could grab what I've been listening to on Spotify-->
            <!--Maybe could have the Python file involved in here?-->
        <title>Mickey's Marvels</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <!--
        <form action="insertion.php" method="post">

            <label for="title-input">Please enter the album's name: </label>
            <input type="text" name="title-input" id="title-input" required>
            <br>
            <label for="album_cover-input">Please enter the link to the album cover: </label>
            <input type="text" name="album_cover-input" id="album_cover-input" required>
            <br>
            <label for="rating-input">Please enter your rating: </label>
            <input type="text" name="rating-input" id="rating-input" required>
            <br>
            <label for="genre-input">Please enter the genre(s) of the album: </label>
            <input type="text" name="genre-input" id="genre-input" required>
            <br>
            <label for="thoughts-input">Please enter your thoughts on the album: </label>
            <input type="text" name="thoughts-input" id="thoughts-input" required>
            <br>
            <input type="submit" value="Submit">
            <br>
        </form>
        -->
        <div id="music-section">
            <div id="review-envelope">
                <div id="reviews-section">
                    <table>
                    <!--This is here for displaying the entries thus far on the webpage when the user loads in-->
                        <?php
                            $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                            $cleardb_server = $cleardb_url["host"];
                            $cleardb_username = $cleardb_url["user"];
                            $cleardb_password = $cleardb_url["pass"];
                            $cleardb_db = substr($cleardb_url["path"],1);
                            $active_group = 'default';
                            $query_builder = TRUE;
                            // Connect to DB
                            $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

                            $query = "SELECT * FROM reviews";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()){
                                    // Try to make it into a drop down table?
                                    echo "<tr id=\"information\">";
                                        echo "<td id=\"title\">" . $row['title'] . "</td>";
                                        echo "<td id=\"rating\">" .$row['rating'] . "</td>";
                                        echo "<td id=\"genre\">" . $row['genre'] . "</td>";
                                    echo "</tr>";
                                    echo "<tr id=\"information\">";
                                        echo "<td id=\"album_cover\"><img id=\"cover\" src=\"" .$row['album_cover'] . "\"></td>";
                                        echo "<td id=\"thoughts\" colspan=\"2\">" . $row['thoughts'] . "</td>";
                                    echo "</tr>";
                                    echo "<tr id=\"blank-row\" colspan=\"3\"></tr>";
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div id="python-scripting">
                <table id="currently-listening">
                    <tr>
                        <th colspan="2">What have I been listening to ... </th>
                    </tr>
                    <?php
                        // Turn this into a table
                        $command = escapeshellcmd('python index.py');
                        $output = shell_exec($command);
                        $results = explode("\n", $output);

                        foreach($results as $row){
                            $entries = explode("`", $row);
                            $song_cover = $entries[1];
                            $song_title = $entries[0];
                            $link = $entries[2];
                            $artists = $entries[3];

                            if (empty($artists) == FALSE){
                                echo "<tr>";
                                echo "<td id=\"song_cover\" rowspan=\"2\"><img id=\"song_cover_img\" src=\"$song_cover\"></td>";
                                echo "<td id=\"song_title\"><a target=\"_blank\" id=\"clickable\" href=\"$link\">$song_title</a></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td id=\"artists\">$artists</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>