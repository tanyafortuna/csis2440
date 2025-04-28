<?php
  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

  $submitted = !empty($_POST);

  // robot class
  class Robot {
    private $model;
    private $color;
    private $os;
    private $size;
    private $law1 = false;
    private $law2 = false;
    private $law3 = false;
    private $imgUrl;

    public function __construct($m, $c, $o, $s, $l1, $l2, $l3)
    {
      $this->setModel($m);
      $this->setColor($c);
      $this->setOS($o);
      $this->setSize($s);
      $this->setLaw1($l1);
      $this->setLaw2($l2);
      $this->setLaw3($l3);
      $this->setImgUrl($m);
    }

    public function setModel($x) { $this->model = $x; }
    public function setColor($x) { $this->color = $x; }
    public function setOS($x) { $this->os = $x; }
    public function setSize($x) { $this->size = $x; }
    public function setLaw1($x) { $this->law1 = $x; }
    public function setLaw2($x) { $this->law2 = $x; }
    public function setLaw3($x) { $this->law3 = $x; }
    public function setImgUrl($x) {  
      $this->imgUrl = 'img/robot-' . preg_replace('(-| )', '', strtolower($x)) . '.jpg';
    }

    public function getModel() { return $this->model; }
    public function getColor() { return $this->color; }
    public function getOS() { return $this->os; }
    public function getSize() { return $this->size; }
    public function getLaw1() { return $this->law1; }
    public function getLaw2() { return $this->law2; }
    public function getLaw3() { return $this->law3; }
    public function getImgUrl() { return $this->imgUrl; }
    
    public function __toString() {
      $output = '<div id="to-string">This is a top-of-the-line robot! You chose the luxury '.$this->getColor().' color of our coveted '.$this->getModel().' model in a perfectly '.$this->getSize().' size, featuring the latest '.$this->getOS().' operating system. ';
      
      $count = 0;
      if ($this->getLaw1()) $count++;
      if ($this->getLaw2()) $count++;
      if ($this->getLaw3()) $count++;

      $output .= 'Your robot will obey ';
      if ($count == 3) 
        $output .= 'all three Laws of Robotics. What could go wrong?'; 
      else if ($count == 2)
      {
        if (!$this->getLaw1())
          $output .= 'the Second and Third Laws of Robotics. That first one is silly, anyway.';
        else if (!$this->getLaw2())
          $output .= 'the First and Third Laws of Robotics. That second one is silly, anyway.';
        else
          $output .= 'the First and Second Laws of Robotics. That third one is silly, anyway.';
      }
      else if ($count == 1)
      {
        if ($this->getLaw1())
          $output .= 'the First Law of Robotics. How important could the other ones be?';
        else if ($this->getLaw2())
          $output .= 'the Second Law of Robotics. How important could the other ones be?';
        else
          $output .= 'the Third Law of Robotics. How important could the other ones be?';
      }
      else
        $output .= 'none of the Laws of Robotics. I\'m sure that\'ll be fine...';
      
      $output .= '</div>';
      return $output;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/script.js" defer></script>
  <title>Robot Maker</title>
</head>
<body>
  <main>
    <?php 
      if (!$submitted) {
        echo printFormHeadingSection();
        echo printFormSection();
      }
      else {
        $m = $_POST['robot-model'];
        $c = $_POST['robot-color'];
        $o = $_POST['robot-os'];
        $s = $_POST['robot-size'];
        $l1 = (isset($_POST['robot-law1']) && $_POST['robot-law1'] == "true");
        $l2 = (isset($_POST['robot-law2']) && $_POST['robot-law2'] == "true");
        $l3 = (isset($_POST['robot-law3']) && $_POST['robot-law3'] == "true");
        $robot = new Robot($m, $c, $o, $s, $l1, $l2, $l3);

        echo printResultsHeadingSection();
        echo printResultsSection1($robot);
        echo var_dump($robot);
;       echo printResultsSection2();
      }
    ?>
  </main>
</body>
</html>

<?php
  

  // create a robot
  function createRobot() {
    $m = $_POST['robot-model'];
    $c = $_POST['robot-color'];
    $o = $_POST['robot-os'];
    $s = $_POST['robot-size'];
    $l1 = (isset($_POST['robot-law1']) && $_POST['robot-law1'] == "true");
    $l2 = (isset($_POST['robot-law2']) && $_POST['robot-law2'] == "true");
    $l3 = (isset($_POST['robot-law3']) && $_POST['robot-law3'] == "true");
    
    return new Robot($m, $c, $o, $s, $l1, $l2, $l3);
  }

  // printing functions
  function printFormHeadingSection() {
    $output = '<section id="heading-section">';
    $output .= '<h1>Build-a-Bot</h1>';
    $output .= '<p>Enter some details below and our workshop automas will create the robot of your dreams!</p>';
    $output .= '</section>';
    
    return $output;
  }

  function printFormSection() {
    $output = '<section id="form-section">';
    $output .= '<form method="post" id="robotform" name="robotform">';
    $output .= '<div id="columns">';
    $output .= '<div id="left-column">';

    $output .= '<div id="robot-model-div">';
    $output .= '<label class="block" for="robot-model">Select your model:</label>';
    $output .= '<select name="robot-model" id="robot-model" onchange="checkIfFormComplete();">';
    $output .= '<option value="">Choose one:</option>';
    $output .= '<option value="Sonny">Sonny</option>';
    $output .= '<option value="Rosey">Rosey</option>';
    $output .= '<option value="SICO">SICO</option>';
    $output .= '<option value="Data">Data</option>';
    $output .= '<option value="Gort">Gort</option>';
    $output .= '<option value="Wall-E">Wall-E</option>';
    $output .= '<option value="Optimus Prime">Optimus Prime</option>';
    $output .= '<option value="Hal 9000">Hal 9000</option>';
    $output .= '<option value="Twiki">Twiki</option>';
    $output .= '<option value="Bender">Bender</option>';
    $output .= '<option value="Johnny 5">Johnny 5</option>';
    $output .= '</select>';
    $output .= '</div>';

    $output .= '<div id="robot-color-div">';
    $output .= '<label class="block" for="robot-color">Select your color:</label>';
    $output .= '<select name="robot-color" id="robot-color" onchange="checkIfFormComplete();">';
    $output .= '<option value="">Choose one:</option>';
    $output .= '<option value="shiny">Shiny</option>';
    $output .= '<option value="chrome">Chrome</option>';
    $output .= '<option value="silver">Silver</option>';
    $output .= '<option value="brass">Brass</option>';
    $output .= '<option value="gold">Gold</option>';
    $output .= '</select>';
    $output .= '</div>';

    $output .= '<div id="robot-os-div">';
    $output .= '<label class="block" for="robot-os">Select your OS:</label>';
    $output .= '<select name="robot-os" id="robot-os" onchange="checkIfFormComplete();">';
    $output .= '<option value="">Choose one:</option>';
    $output .= '<option value="Linux">Linux</option>';
    $output .= '<option value="Unix">Unix</option>';
    $output .= '<option value="SPARC">SPARC</option>';
    $output .= '<option value="Binary">Binary</option>';
    $output .= '<option value="DOS">DOS</option>';
    $output .= '<option value="Tiny Hamsters">Tiny Hamsters</option>';
    $output .= '</select>';
    $output .= '</div>';

    $output .= '<div id="robot-size-div">';
    $output .= '<label class="block">Select your size:</label>';
    $output .= '<div class="sizes-div">';
    $output .= '<div class="size-div">';
    $output .= '<input type="radio" name="robot-size" value="giant" id="giant" onclick="checkIfFormComplete();">';
    $output .= '<label for="giant">Giant</label>';
    $output .= '</div>';
    $output .= '<div class="size-div">';
    $output .= '<input type="radio" name="robot-size" value="normal" id="normal" onclick="checkIfFormComplete();">';
    $output .= '<label for="normal">Normal</label>';
    $output .= '</div>';
    $output .= '<div class="size-div">';
    $output .= '<input type="radio" name="robot-size" value="nano" id="nano" onclick="checkIfFormComplete();">';
    $output .= '<label for="nano">Nano</label>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div id="right-column">';
    $output .= '<label class="block">Select your Laws of Robotics:</label>';
    $output .= '<div id="robot-laws-div">';
    $output .= '<div class="laws-div">';
    $output .= '<div class="laws-checkbox-div">';
    $output .= '<input type="checkbox" value="true" name="robot-law1" id="robot-law1">';
    $output .= '<label for="robot-law1"><span class="laws">First Law</span></label>';
    $output .= '</div>';
    $output .= '<label for="robot-law1" class="indented">A robot may not injure a human being or, through inaction, allow a human being to come to harm.</label>';
    $output .= '</div>';
    $output .= '<div class="laws-div">';
    $output .= '<div class="laws-checkbox-div">';
    $output .= '<input type="checkbox" value="true" name="robot-law2" id="robot-law2">';
    $output .= '<label for="robot-law2"><span class="laws">Second Law</span></label>';
    $output .= '</div>';
    $output .= '<label for="robot-law2" class="indented">A robot must obey the orders given it by human beings except where such orders would conflict with the First Law.</label>';
    $output .= '</div>';
    $output .= '<div class="laws-div">';
    $output .= '<div class="laws-checkbox-div">';
    $output .= '<input type="checkbox" value="true" name="robot-law3" id="robot-law3">';
    $output .= '<label for="robot-law3"><span class="laws">Third Law</span></label>';
    $output .= '</div>';
    $output .= '<label for="robot-law3" class="indented">A robot must protect its own existence as long as such protection does not conflict with the First or Second Law.</label>';
    $output .= '</div>';
    $output .= '</div>';
    
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div id="submit-div">';
    $output .= '<input type="submit" name="submit" id="submit" value="Build Robot" disabled>';
    $output .= '</div>';
    $output .= '</form>';
    $output .= '</section>';

    return $output;
  }

  function printResultsHeadingSection() {
    $output = '<section id="heading-section">';
    $output .= '<h1>Robot in progress!</h1>';
    $output .= '<p>Our workshop automa are diligently following your instructions and working tirelessly to get your robot ready.</p>';
    $output .= '</section>';
    
    return $output;
  }

  function printResultsSection1($robot) {
    $output = '<section id="results-section">';
    $output .= '<p id="order-number">Your order number is: '.rand(999, 9999).'</p>';
    // $output .= '<div id="order-confirmation">The following is a summary of your order.</div>';

    $output .= '<p>The robot you selected:</p>';
    $output .= '<div id="to-string-div">';
    $output .= '<div class="indented">';
    $output .= $robot;
    $output .= '</div>';
    $output .= '<div id="robot-img-div">';
    $output .= '<img id="robot-img" src="'.$robot->getImgUrl().'">';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div id="var-dump-div">';
    $output .= '<p>The order as our automa have received it:</p>';
    $output .= '<div class="indented">';
  
    return $output;
  }

  function printResultsSection2() {
    $output = '</div>';
    $output = '</div>';
    $output .= '</section>';
  
    return $output;
  }
?>