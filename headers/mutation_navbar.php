<?
  function mutation_navbar($page) { ?>
    <div class="mutate_navBar">          
      <input class="submitButton mutateButton <? if($page == "substitution") echo "mutateButtonActive" ?>" 
        id="Substitution" type = "button" value = "Substitution" onclick="window.location = '../substitution/substitution.php'"/>

      <input class="submitButton mutateButton <? if($page == "insertion") echo "mutateButtonActive" ?>" 
        id="Insertion" type = "button" value = "Insertion" onclick=""/>

      <input class="submitButton mutateButton <? if($page == "deletion") echo "mutateButtonActive" ?>" 
        id="Deletion" type = "button" value = "Deletion" onclick="window.location = '../deletion/deletion.php'"/>
        
      <input type="hidden" id="mutateState" value="substitution" />
    </div>
<?
  }
?>