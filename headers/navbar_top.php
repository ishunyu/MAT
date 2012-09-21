<?
  function topBar($page) { ?>
		<div class="topBar" class="">
		  <div class="textShadow welcome">Welcome, <? echo $_SESSION['name_first'] ?>!</div>
		  <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
		  <!-- NAV BAR-->
		  <table class="navBar">
			<tr>
			  <td class="navBarItem <? if($page == "catalog") echo "selectedNavBarItem" ?>"><a class="navBarItem" id="" href="../catalog/catalog.php">Catalog</a></td>
			  <td class="navBarItem <? if($page == "upload") echo "selectedNavBarItem" ?>"><a class="navBarItem" id="" href="../upload/upload.php">Upload</a></td>
			  <td class="navBarItem <? if($page == "features") echo "selectedNavBarItem" ?>"><a class="navBarItem" id="" href="../features/features.php">Features</a></td>
			  <td class="navBarItem <? if($page == "annotation") echo "selectedNavBarItem" ?>"><a class="navBarItem" id="" href="../annotation/annotation.php">Annotation</a></td>
			  <td class="navBarItem <? if($page == "mutation") echo "selectedNavBarItem" ?>"><a class="navBarItem" id="" href="../deletion/deletion.php">Mutation</a></td>		  
			</tr>
		  </table>
		</div>

<?   
  }
?>