<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File Browser</title>

        <link rel="stylesheet" href="main.css">
        <link rel="shortcut icon" href="img/Folder.png">
    </head>
    <body>
        <section class="sec1">
            <h1>File Browser</h1>
            <section>
                <p>Made by: Berend Jak</p>
                <p>March 2016</p>
            </section>
        </section>
        <section class="secmid">
            <section class="midleft">
                <h2>Folders & Files</h2>
            </section>
            <section class="midright">
                <h2>File Info</h2>
            </section>

        </section>
        <section class="secbot">
            <section class="sec2">
                <?php

                function human_filesize($bytes, $decimals = 2) {
                    $size = array('B', 'kB', 'MB', 'GB', 'TB');
                    $factor = floor((strlen($bytes) - 1) / 3);
                    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
                }

                if (isset($_GET["map"])) {
                    $dir = $_GET["map"];
                    $dir = realpath($dir) . '\\';

//                    if (strpos($dir, "FileBrowser")) {
//                        
//                    } else {
//                        $dir = getcwd() . '\\';
//                    }
                } else {
                    $dir = getcwd() . '\\';
                }

                $sDir = scandir($dir);



                $Folder = '<img alt="" src="img/Folder.png">';
                $fileCss = '<img alt="" src="img/css.png">';
                $fileXml = '<img alt="" src="img/xml.png">';
                $fileProp = '<img alt="" src="img/properties.png">';
                $fileScss = '<img alt="" src="img/scss.png">';
                $filePhp = '<img alt="" src="img/php.png">';
                $filePng = '<img alt="" src="img/png.png">';
                $fileMap = '<img alt="" src="img/map.png">';
                $fileJpg = '<img alt="" src="img/jpg.png">';
                $fileGif = '<img alt="" src="img/gifi.ico">';
                $fileUnk = '<img alt="" src="img/unknown.png">';

                foreach ($sDir as $items) {
                    if (is_file($dir . '/' . $items)) {
                        $file_parts1 = pathinfo($items);
                        if ($file_parts1['extension'] == "css") {
                            echo '<br><a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileCss . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "png") {
                            echo '<br><a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $filePng . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "scss") {
                            echo '<br><a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileScss . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "properties") {
                            echo '<br><a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileProp . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "xml") {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileXml . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "map") {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileMap . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "jpg") {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileJpg . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "gif") {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileGif . '<span>' . $items . '</span>' . '</pre></a>';
                        } elseif ($file_parts1['extension'] == "php") {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $filePhp . '<span>' . $items . '</span>' . '</pre></a>';
                        } else {
                            echo '<br> <a href="index.php?map=' . $dir . '&amp;bestand=' . $items . '"><pre>' . $fileUnk . '<span>' . $items . '</span>' . '</pre></a>';
                        }
                    } else {
                        echo '<br><a href="index.php?map=' . $dir . $items . '"><pre>' . $Folder . '<span>' . $items . '</span>' . '</pre></a>';
                    }
                }
                ?>
            </section>
            <section class="secmid" id="fileinfosm">
                <h2>File Info</h2>
            </section>
            <section class="sec3">
                <?php
                if (isset($_GET["bestand"])) {
                    $write = $_GET["bestand"];
                    echo 'Filename: ' . $write;
                    $file_parts1 = pathinfo($items);
                    if (is_writable($write)) {
                        echo '<br><br>Editable';
                        echo '<br><br>Size: ' . human_filesize(filesize($dir . $write)) . "<br><br>";
                        echo "Last modified: " . date("d F Y H:i:s.", filemtime($write)) . '<br>';

                        $url = "http://localhost/FileBrowser/index.php?map=C:/xampp/htdocs/Filebrowser/index.php?map=' . $dir . '&amp;bestand=' . $items";

                        if (isset($_POST['text'])) {
                            file_put_contents($write, $_POST['text']);
                            printf('<br><br><a align="center" href="">Updated</a>', htmlspecialchars($url));
                            exit();
                        }
                        $text = file_get_contents($write);

                        echo '<br><h3>Content<br><br></h3><form action="" method="post"><textarea name="text">' . htmlspecialchars($text) . '</textarea><input type="submit" value="Update"><input type="reset" value="Reset"></form>';
                    } elseif ($file_parts1['extension'] == "png" || $file_parts1['extension'] == "gif" || $file_parts1['extension'] == "jpg") {
                        echo '<br><br>Not Editable';
                        echo '<br><br>Size: ' . human_filesize(filesize($dir . $write)) . "<br><br>";
                        echo '<br><br><img alt="" src="img/' . $write . '">';
                    } else {
                        echo '<br><br>Not Editable';
                        echo '<br><br>Size: No information' . "<br><br>";
                        echo '<br><br>Can not show content';
                    }
                } else {
                    $dir = getcwd() . '/';
                }
                ?> 

            </section>
        </section>
    </body>
</html>
