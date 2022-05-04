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
            <th>Status</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Date Time GMT</th>
            <th>Teams</th>
        </tr>
        </thead>
        <tbody>
        <?php

                    $matchList   = array();
                    $apikey      = "%APIKEY%";
                    $id          = "7e47dce6-f086-469d-81b0-54c04e56ca61";
                    $json_result = file_get_contents('https://api.cricapi.com/v1/series_info?apikey='.$apikey.'&offset=0&id='.$id);
                    $series_search_data = json_decode($json_result);
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $results = $series_search_data->data;
                        $matchList[] = $results->matchList;   
                    }
                    if(!empty($matchList)){
                        foreach($matchList as $list){
                        foreach($list as $listdata){
                    ?>
                    <tr>
                        <td><?php if(isset($listdata->name)) { echo $listdata->name; }else{ echo "No name Found"; } ?></td>
                        <td><?php if(isset($listdata->status)) { echo $listdata->status;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($listdata->venue)) { echo $listdata->venue; }else{ echo "No  venue Found" ; } ?></td>
                        <td><?php if(isset($listdata->date)) { echo $listdata->date; }else{ echo  "No date Found";} ?></td>
                        <td><?php if(isset($listdata->dateTimeGMT)) { echo $listdata->dateTimeGMT; }else{ echo  "No date Data Found"; } ?></td>
                        <td><?php if(isset($listdata->teams)) { 
                            for($i=0;$i<count($listdata->teams);$i++){
                                echo $listdata->teams[$i]." <br>";
                            }
                        }else{ echo "No teams Data Found"; } ?></td>
                      </tr>
                     <?php 
                     }
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


