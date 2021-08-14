<?php

function sqli($data)
{

return $data;

}

?>

<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Architects+Daughter">-->
<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>

<title>SQLite-CTF</title>

</head>

<body>



<div id="main">

    <h1>NULL Chapter</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="GET">

        <p>

        <label for="title">Search for a movie:</label>
        <input type="text" id="title" name="title" size="25">

        <button type="submit" name="action" value="search">Search</button> &nbsp;&nbsp;

        </p>

    </form>

    <table id="table_yellow">

        <tr height="30" bgcolor="#ffb717" align="center">

            <td width="200"><b>Title</b></td>
            <td width="80"><b>Release</b></td>
            <td width="140"><b>Character</b></td>
            <td width="80"><b>Genre</b></td>
            <td width="80"><b>IMDb</b></td>

        </tr>
<?php

if(isset($_GET["title"]))
{

    $title = $_GET["title"];

    $db = new PDO('sqlite:bwapp.sqlite');

    $sql = "SELECT * FROM movies WHERE title LIKE '%" . sqli($title) ."%'";

    $recordset = $db->query($sql);

    if(!$recordset)
    {

?>

        <tr height="50">

            <td colspan="5" width="580"><?php die("Error: " . $db->errorCode()); ?></td>

        </tr>
<?php

    }

    $count = 0;

    foreach($recordset as $row)
    {

	$count++;

?>

        <tr height="30">

            <td><?php echo $row["title"]; ?></td>
            <td align="center"><?php echo $row["release_year"]; ?></td>
            <td><?php echo $row["main_character"]; ?></td>
            <td align="center"><?php echo $row["genre"]; ?></td>
            <td align="center"><a href="http://www.imdb.com/title/<?php echo $row["imdb"]; ?>" target="_blank">Link</a></td>

        </tr>
<?php

    }    

    if ($count == 0)
    {

?>

        <tr height="30">

            <td colspan="5" width="580">No movies were found!</td>

        </tr>
<?php

    }

    $db = null;
}
else
{
?>
        <tr height="30">

            <td colspan="5" width="580"></td>

        </tr>
<?php

}

?>
    </table>

</div>

</body>

</html>
