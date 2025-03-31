<?php
  function addToDB($choice) {
    // get connection
    $conn = connectToDB();

    // create command
    $sql = 'update cheese set votes = (votes + 1) where name = "'. $choice .'"';

    // run command
    mysqli_query($conn, $sql);

    // close connection
    mysqli_close($conn);
  }

  function getSortedDB() {
    // get connection
    $conn = connectToDB();

    // create command
    $sql = 'SELECT * FROM cheese;';

    // run command
    $results = mysqli_query($conn, $sql);

    // create associative array from results
    while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
      $votes[$record['name']] = $record['votes'];
      $v[] = $record['votes'];
    }

    // sort results
    array_multisort($v, SORT_DESC, $votes);

    // close connection
    mysqli_close($conn);

    // return results
    return $votes;
  }

  function printPollResults() {
    $html = '';
    foreach (getSortedDB() as $n => $v) {
      $html .= '<div class="result-item">';
      $html .= '<span class="cheese-name">';
      $html .= $n;
      $html .= '</span><span class="num-votes">';
      $html .= $v;
      $html .= ' votes</span>';
      $html .= '<div class="result-bar" style="width: ';
      $html .= max(1, 4 * getVotePercentage($v));
      $html .= 'px;"></div>';
      $html .= '</div>';
    }
    return $html;
  }

  function getVotePercentage($num) {
    return 100 * $num / array_sum(array_values(getSortedDB()));
  }
?>