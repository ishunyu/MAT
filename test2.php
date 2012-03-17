<html>
  <head>
    <title>test.php</title>
    <style type="text/css" >
    div.x {
      width:400px;
      margin-left:auto;
      margin-right:auto;
      text-align:center;
    }    
    </style>
    <?php include "test.php" ?>
  </head>
  <body>
    <div class="x">
    <h4>Please enter the location of your codon:</h4>
      <form action="test2.php" method="POST">
        <input type="text" id="location" name="location" />
        <input type="submit" value="submit" />
      </form>   
      
      
      <form name="codonForm" action="test2.php" method="POST">
        <h4>Please enter a codon:</h4>
        <input type="text" id="codon" tabindex="-1"/>
        <input type="submit" name="codonInput" value="submit" />    
      </form>
      <?php if($output != "") {
              echo $output;
             }
             else {
              echo "</br>";
             }
      ?>
    </div>
    <script type="text/javascript">
      document.getElementById('codon').focus();
    </script>    
  </body>
</html>