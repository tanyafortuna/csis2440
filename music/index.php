<?php
  error_reporting(-1);
  ini_set( 'display_errors', 1 );
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Best Albums Ever</title>
</head>
<body>
  <main>
    <h1>My Favorite Albums</h1>
    <table>
      <thead>
        <tr>
          <th>Album</th>
          <th>Artist</th>
        </tr>
      </thead>
      <tbody>
        <?php echo getTableData(); ?>
      </tbody>
    </table>
  </main>
</body>
</html>

<?php

  function getTableData() {
    $artistList = [
      "The Presidents of the United States of America", 
      "Gipsy Kings", 
      "Girl Talk", 
      "Various Artists", 
      "Garbage", 
      "Moby", 
      "Radiohead", 
      "Third Eye Blind", 
      "Chromeo", 
      "The Beatles"];
    $albumList = [
      "The Presidents of the United States of America", 
      "¡Volare! The Very Best of the Gipsy Kings", 
      "Night Ripper", 
      "Eurotrip (Original Soundtrack)", 
      "Version 2.0", 
      "Play", 
      "OK Computer", 
      "Third Eye Blind", 
      "Fancy Footwork", 
      "Abbey Road"];
    $links = [
      "https://www.youtube.com/watch?v=lsD4cSPlcU8&list=PLAPutL8Hvihm-OZZEDDaKj03EZJWSK2y0",
      "https://www.youtube.com/watch?v=znxb6KtOo_c&list=OLAK5uy_mjs9EIzKiNmx1feU-DbcEySb20_G2A13k",
      "https://www.youtube.com/watch?v=BtvkeklCojc&list=OLAK5uy_m_skLgmD7UOM_g5LN8ITKspovVwZiNeQs",
      "https://www.youtube.com/watch?v=9iNo9iLxeME&list=PLoYF8Gv4x6bdGPUBOhk57OpJC4t6CZZM9",
      "https://www.youtube.com/watch?v=TAnFXdBGTNc&list=PLn2d0gb5THChRnb1TzM4LBjXpUL3eEN97",
      "https://www.youtube.com/watch?v=J-o0f-m5-hY&list=PLbfZd8Deo-GqgzGoxUP6kX-G_GGK6qHab",
      "https://www.youtube.com/watch?v=jNY_wLukVW0&list=PLxzSZG7g8c8x6GYz_FcNr-3zPQ7npP6WF",
      "https://www.youtube.com/watch?v=MwlqymYLCb4&list=PLNZZNq_IdVIoHdPym976kDtdmkAZ6ZhE1",
      "https://www.youtube.com/watch?v=jwnCWAQGdR8&list=OLAK5uy_m4g3UrtA59YWqjN3MnAm5nVm7om4p7TMc",
      "https://www.youtube.com/watch?v=oolpPmuK2I8&list=PLPMRFtA0BgE6ce0olKAwrKffd-V170IEC"];
    $randomizer = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    shuffle($randomizer);

    $tableRow = "";

    for ($i = 0; $i < 10; $i++) {
      $tableRow .= "<tr><td><a href=\"";
      $tableRow .= $links[$randomizer[$i]];
      $tableRow .= "\">";
      $tableRow .= $albumList[$randomizer[$i]];
      $tableRow .= "</a></td><td>";
      $tableRow .= $artistList[$randomizer[$i]];
      $tableRow .= "</td></tr>";
    }

    return $tableRow;
  }

?>