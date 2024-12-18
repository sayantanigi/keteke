<!DOCTYPE html>
<html>
<body>
 <table width="100%" border=1>
   <thead>
     <tr align="center">
       <th width="6%">id</th>
       <th>title</th>
       <th>country</th>
       <th>category</th>
       <th>location</th>
       <th>descr</th>
       <th>phone</th>
       <th>email</th>
       <th>website</th>
       <th>fax</th>
       <th>lati</th>
       <th>longi</th>
       <th></th>
     </tr>
   </thead>
   <tbody>
    <?php if(is_array($data) && count($data)>0){
      
      foreach ($data as $d) {
        ?>
        <tr align="center">
         <td></td>
         <td><?=$d['title']?></td>
         <td><?=$d['country']?></td>
         <td><?=$d['category']?></td>
         <td><?=$d['location']?></td>
         <td><?=$d['descr']?></td>
         <td><?=$d['phone']?></td>
         <td><?=$d['email']?></td>
         <td><?=$d['website']?></td>
         <td><?=$d['fax']?></td>
         <td><?=$d['lati']?></td>
         <td><?=$d['longi']?></td>
         <td></td>
       </tr>
       <?php
       }
     } ?>
   </tbody>
 </table> 

</body>
</html>
