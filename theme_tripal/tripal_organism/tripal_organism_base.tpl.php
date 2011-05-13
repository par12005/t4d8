<?php
  $organism = $variables['node']->organism;
  
?>
<div id="tripal_organism-base-box" class="tripal_organism-info-box tripal-info-box">
  <div class="tripal_organism-info-box-title tripal-info-box-title">Organism Details</div>
  <div class="tripal_organism-info-box-desc tripal-info-box-desc"></div>
   <img src=<?php print file_create_url(file_directory_path() . "/tripal/tripal_organism/images/".$organism->genus."_".$organism->species.".jpg")?>>
   <table id="tripal_organism-table-base" class="tripal_organism-table tripal-table tripal-table-vert">
      <tr class="tripal_organism-table-odd-row tripal-table-even-row">
        <th>Common Name</th>
        <td><?php print $organism->common_name; ?></td>
      </tr>
      <tr class="tripal_organism-table-odd-row tripal-table-odd-row">
        <th>Genus</th>
        <td><?php print $organism->genus; ?></td>
      </tr>
      <tr class="tripal_organism-table-odd-row tripal-table-even-row">
        <th>Species</th>
        <td><?php print $organism->species; ?></td>
      </tr>
      <tr class="tripal_organism-table-odd-row tripal-table-odd-row">
        <th>Abbreviation</th>
        <td><?php print $organism->abbreviation; ?></td>
      </tr>         	                                
   </table>
   <table  id="tripal_organism-table-description" class="tripal_organism-table tripal-table tripal-table-horz">
      <tr class="tripal_organism-table-odd-row tripal-table-even-row">
        <td><?php print $organism->comment; ?></td>
      </tr>        	                                
   </table>
</div>
