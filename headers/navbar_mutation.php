<?
  function mutation_navbar($page) { ?>
    <div class="mutate_navBar">          
      <input class="submitButton mutate_button <? if($page == "substitution") echo "mutate_button_active" ?>" 
        id="Substitution" type = "button" value = "Substitution" onclick="window.location = '../substitution/substitution.php'"/>

      <input class="submitButton mutate_button <? if($page == "insertion") echo "mutate_button_active" ?>" 
        id="Insertion" type = "button" value = "Insertion" onclick=""/>

      <input class="submitButton mutate_button <? if($page == "deletion") echo "mutate_button_active" ?>" 
        id="Deletion" type = "button" value = "Deletion" onclick="window.location = '../deletion/deletion.php'"/>
        
      <input type="hidden" id="mutateState" value="substitution" />
    </div>
<?
  }
?>