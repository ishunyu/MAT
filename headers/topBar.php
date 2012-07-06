<?
  function topBar($page) { ?>
	<!-- TOP BAR-->
		<div class="topBar" class="">
		  <div class="textShadow welcome">Welcome, <? echo $_SESSION['firstName'] ?>!</div>
		  <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
		  <!-- NAV BAR-->
		  <table class="navBar">
			<tr>
			  <td class="navBarItem <? if($page == "upload") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../upload/upload.php">Upload</a></td>
			  <td class="navBarItem <? if($page == "substitution") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Substitution</a></td>
			  <td class="navBarItem <? if($page == "insertion") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../insertion/insertion.php">Insertion</a></td>
			  <td class="navBarItem <? if($page == "deletion") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../deletion/deletion.php">Deletion</a></td>
			  <td class="navBarItem <? if($page == "catalog") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../manage/catalog.php">Catalog</a></td>
			</tr>
		  </table>
		</div>

<?   
  }
?>