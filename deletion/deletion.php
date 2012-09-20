<? require_once './__deletion__.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd"> 
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
  <!-- FAVICON -->
  <link rel="icon" href="../favicon.ico" type="image/x-icon"> 
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../styles/main.css">
  <link rel="stylesheet" type="text/css" href="../styles/top_bar.css">
  <link rel="stylesheet" type="text/css" href="../styles/substitution.css">
  
  <!-- JAVASCRIPT -->
  <script type="text/javascript" src="../scripts/deletion.js"></script>
</head>

<body>
  <div class="topBarBackground"></div>
  <!-- MAIN-->
  <div id="div_main" >
  <? topBar("mutation"); ?> 
    
    <!-- CONTENT-->
    <div class="generalContentContainer">
      <!-- GENE DISPLAY-->
      <? if($id_gene != "") { // Used so that nothing displays if there's no genes exist! ?>       
        <span class="titleFormat" ><? echo $title_gene;?></span>
        <? mutation_navbar('deletion'); ?>
        <hr>
        
        <div class="ContentContainer">
          <table id="deletion_input">
            <tr>
              <td><span class="formLabel">First deleted base:</span></td>
              <td><input type="text" id="start_index" class="inputBoxStyle text_small" onkeyup="deletion_info(this)"/></td>
            </tr>
            <tr>
              <td><span class="formLabel">Last deleted base:</span></td>
              <td><input type="text" id="end_index" class="inputBoxStyle text_small" onkeyup="deletion_info(this)"/></td>
            </tr>
            <tr>
              <td>
              </td>
              <td><input type="button" class="" value="Submit" onclick="deletion_info()"></input></td>
            </tr>
          </table>
          <table id="deletion_info" class="info" style="color: white;">
            <tr>
              <th>Deleted Sequence:</th>
              <td id="deleted_seq"></td>
            </tr>
            <tr>
              <th>Number of bases deleted:</th>
              <td id="number_of_bases_deleted"></td>
            </tr>
            <tr>
              <th>&nbsp;</th>
              <td></td>
            </tr>
            <tr>
              <th>Frame retention:</th>
              <td id="frame_retention"></td>
            <tr>
              <th>First affected codon:</th>
              <td id="first_affected_codon"></td>
            </tr>
            <tr>
              <th>Coding for... (WT):</th>
              <td id="codon_info"></td>
            </tr>
            <tr>
              <th>Amino acid position:</th>
              <td id="amino_acid_position"></td>
            </tr>
            <tr>
              <th>&nbsp;</th>
              <td></td>
            </tr>
            <tr>
              <th>Exon (5' - 3' bases):</th>
              <td id="exon"></td>
            </tr>
            <tr>
              <th>Distance to 5' junction (bp):</th>
              <td id="distance_to_5_junction"></td>
            </tr>
            <tr>
              <th>Distance to 3' junction (bp):</th>
              <td id="distance_to_3_junction"></td>
            </tr>
            <tr>
              <th>&nbsp;</th>
              <td></td>
            </tr>
            <tr>
              <th>Deletion only:</th>
              <td id="deletion_only"></td>
            </tr>
            <tr>
              <th>In-frame, single AA:</th>
              <td id="in_frame_single_aa"></td>
            </tr>
            <tr>
              <th>In-frame, multiple AA:</th>
              <td id="in_frame_multiple_aa"></td>
            </tr>
            <tr>
              <th>Non-frame shifting:</th>
              <td id="non_frame_shifting_aa"></td>
            </tr>
            <tr>
              <th>Frame shifting:</th>
              <td id="frame_shifting_aa"></td>
            </tr>
          </table>
        </div>
      <? }
         else { ?>
          <a class="normalLink" href="../upload/upload.php">
            <span class="titleFormat textShadow" >Please upload a DNA Sequence</span> </a>
      <? } ?>
    </div>
  </div>
</body>
</html>
<? mysql_close($connection); ob_end_flush(); ?>