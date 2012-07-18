<?
  function topBar($page) { ?>
	<!-- TOP BAR-->
		<div class="topBar" class="">
		  <div class="textShadow welcome">Welcome, <? echo $_SESSION['firstName'] ?>!</div>
		  <a href="../logout/logout.php" class="textShadow smallLink logout">Logout</a>
		  <!-- NAV BAR-->
		  <table class="navBar">
			<tr>
			  <td class="navBarItem <? if($page == "catalog") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../manage/catalog.php">Catalog</a></td>
			  <td class="navBarItem <? if($page == "annotate") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../manage/annotate.php">Annotate</a></td>
			  <td class="navBarItem <? if($page == "mutate") echo "selectedNavBarItem" ?>"><a class="navBarItem textShadow" id="" href="../mutate/mutate.php">Mutate</a></td>			  
			</tr>
		  </table>
		</div>

<?   
  }
?>