<?php /* +table_catalog.php */

$id_user = $_SESSION['id_user'];

$q_genes =
  "SELECT id, name
   FROM $table_genes
   WHERE id_user = $id_user";
$r_genes = mysql_query($q_genes);    

while($gene = mysql_fetch_assoc($r_genes)) { ?>
  <tr id="<? echo $gene['id']; ?>">
    <th class="formLabel labelColumn"><? echo $gene['name'] ?></th>
    <td>
      <b>
        <a href="../deletion/deletion.php?id_gene=<? echo $gene['id']; ?>" >Mutate</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="../annotation/annotation.php?id_gene=<? echo $gene['id']; ?>" >Annotate</a>&nbsp;&nbsp;&nbsp;&nbsp;
      </b>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="#" onClick="return show(this);">Show</a>&nbsp;&nbsp;
      <a href="../edit/edit.php?id_gene=<? echo$gene['id']; ?>">Edit</a>&nbsp;&nbsp;
      <a href="#" onClick="return del(this);">Delete</a>
  </tr>
<? } ?>