<?
  function topBar($page) { ?>
		<div class="topBar" class="">
		  <div class="textShadow welcome">Welcome, <? echo $_SESSION['firstName'] ?>!</div>
		  <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
		  <!-- NAV BAR-->
		  <table class="navBar">
			<tr>
			  <td class="navBarItem <? if($page == "catalog") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../catalog/catalog.php">Catalog</a></td>
			  <td class="navBarItem <? if($page == "upload") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../upload/upload.php">Upload</a></td>
			  <td class="navBarItem <? if($page == "features") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../features/features.php">Features</a></td>
			  <td class="navBarItem <? if($page == "annotation") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../annotation/annotation.php">Annotate</a></td>
			  <td class="navBarItem <? if($page == "mutation") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../substitution/substitution.php">Mutate</a></td>		  
			</tr>
		  </table>
		</div>

<?   
  }
?>