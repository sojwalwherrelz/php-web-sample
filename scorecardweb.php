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
            <th>Teams Name</th>
            <th>Status</th>
            <th>match Type</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Date Time GMT</th>
            <th>Series Id</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <?php

                    $scorecardList = array();
                    $apikey      = "%APIKEY%";
                    $id   = "fc4a5881-fb19-4d21-933c-45e913dc0d3c"; 
                    $json_result = file_get_contents('https://api.cricapi.com/v1/match_scorecard?apikey='.$apikey.'&offset=0&id='.$id);
                    $series_search_data = json_decode($json_result);
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $scorecardList[] = $series_search_data->data;
                    }
                    if(!empty($scorecardList)){
                        foreach($scorecardList as $list){
                       ?>
                        <tr>
                        <td><?php if(isset($list->name)) { echo $list->name; }else{ echo "No name Found"; } ?></td>
                        <td><?php if(isset($list->status)) { echo $list->status;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->matchType)) { echo $list->matchType;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->venue)) { echo $list->venue; }else{ echo "No  venue Found" ; } ?></td>
                        <td><?php if(isset($list->date)) { echo $list->date; }else{ echo  "No date Found";} ?></td>
                        <td><?php if(isset($list->dateTimeGMT)) { echo $list->dateTimeGMT; }else{ echo  "No date Data Found"; } ?></td>
                        <td><?php if(isset($list->series_id)) { echo $list->series_id; }else{ echo  "No date Data Found"; } ?></td>
                        <td><?php if(isset($list->score)) { 
                        for($i=0;$i<count($list->score);$i++){
                            echo $list->score[$i]->r."<br>";
                            echo $list->score[$i]->w."<br>";
                            echo $list->score[$i]->o."<br>";
                            echo $list->score[$i]->inning."<br>";
                        }
                        }else{ echo "No Score Data Found"; } ?></td>
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


