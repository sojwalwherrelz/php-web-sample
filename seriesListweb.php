<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cricket List </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>T 20 </th>
            <th>ODI</th>
            <th>Test</th>
            <th>Squads</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $seriesList  = array();
        $maxOffset   = 1;
        $apikey      = "%APIKEY%";
        $json_result = file_get_contents('https://api.cricapi.com/v1/series?apikey='.$apikey.'&offset=0');
        $j = json_decode($json_result);
        if($j->status != "success") {
            die("FAILED TO GET A SUCCESS RESULT");
        }
        $maxOffset = $j->info->totalRows;
        $offset += count($j->data);
        $seriesList = array_merge($seriesList,$j->data);
        ?>
        <?php 
        if(!empty($seriesList)){
            foreach($seriesList as $list){
        ?>
        <tr>
            <td><?php echo $list->name; ?></td>
            <td><?php if(isset($list->startDate)) { echo $list->startDate;}else{ echo "No Date Found"; } ?></td>
            <td><?php if(isset($list->endDate)) { echo $list->endDate; }else{ echo "No  endDate Found" ; } ?></td>
            <td><?php if(isset($list->odi)) { echo $list->odi; }else{ echo  "No ODI Found";} ?></td>
            <td><?php if(isset($list->t20)) { echo $list->t20; }else{ echo  "No T20 Data Found"; } ?></td>
            <td><?php if(isset($list->test)) { echo $list->test; }else{ echo "No Test Data Found"; } ?></td>
            <td><?php if(isset($list->squads)) { echo $list->squads; }else{ echo "No squads Data Found"; } ;  ?></td>
            <td><?php if(isset($list->matches)) { echo $list->matches; }else{ echo "No matches Data Found" ; } ?></td>
        </tr>
        <?php 
        }
        }else{
            echo "Data Not Found";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>


