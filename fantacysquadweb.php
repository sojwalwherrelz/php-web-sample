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
            <th>Team Name</th>
            <th>Players Name</th>
        </tr>
        </thead>
        <tbody>
        <?php

                    $matchList   = array();
                    $apikey      = "%APIKEY%";
                    $id          ="119f27e8-cb92-4ddf-b275-a2d265cec2dd";
                    $json_result = file_get_contents('https://api.cricapi.com/v1/match_squad?apikey='.$apikey.'&offset=0&id='.$id);
                    $series_search_data = json_decode($json_result);
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $matchList[] = $series_search_data->data;
                    }
                    if(!empty($matchList)){
                        foreach($matchList as $list){
                        foreach($list as $listdata){      
                    ?>
                    <tr>
                        <td><?php if(isset($listdata->teamName)) { echo $listdata->teamName; }else{ echo "No name Found"; } ?></td>
                        <td><?php if(isset($listdata->players)) { 
                        for($i=0;$i<count($listdata->players);$i++){
                             echo "<ul>";
                             if(isset($listdata->players[$i]->name)) 
                             {
                               echo "<li>".$listdata->players[$i]->name."</li>";
                            }
                            if(isset($listdata->players[$i]->role)) 
                            {
                               echo "<li>".$listdata->players[$i]->role."</li>";
                            }
                            if(isset($listdata->players[$i]->battingStyle)) 
                            {
                                echo "<li>".$listdata->players[$i]->battingStyle."</li>";
                            }
                            if(isset($listdata->players[$i]->bowlingStyle)) 
                            {
                                 echo "<li>".$listdata->players[$i]->bowlingStyle."</li>";
                            }
                            echo "</ul>";
                        }
                        }else{ echo "No players Data Found"; } ?></td>
                        
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


