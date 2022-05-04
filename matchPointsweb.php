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
            <th>Batting</th>
            <th>Bowling</th>
            <th>Catching</th>

           
        </tr>
        </thead>
        <tbody>
        <?php

                    $matchList   = array();
                    $apikey      = "%APIKEY%";        
                    $id          = "119f27e8-cb92-4ddf-b275-a2d265cec2dd";
                    $json_result = file_get_contents('https://api.cricapi.com/v1/match_points?apikey='.$apikey.'&offset=0&id='.$id);
                    $series_search_data = json_decode($json_result);
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $matchList[] = $series_search_data->data;       
                    }
                    if(!empty($matchList)){
                        foreach($matchList as $list){
                        foreach($list->innings as $listdata){                               
                    ?>

                    <tr>
                        <td><?php if(isset($listdata->inning)) { echo $listdata->inning; }else{ echo "No name Found"; } ?></td>
                        <td>
                            <?php if(isset($listdata->batting)) { 
                            for($i=0;$i<count($listdata->batting);$i++){
                             echo "<ul>";
                             if(isset($listdata->batting[$i]->name)) 
                             {
                               echo "<li> Name : ".$listdata->batting[$i]->name."</li>";
                            }
                            if(isset($listdata->batting[$i]->points)) 
                            {
                               echo "<li> Points :".$listdata->batting[$i]->points."</li>";
                            }
                            
                            echo "</ul>";
                        }
                        }else{ echo "No batting Data Found"; } ?>
                        </td>

                        <td><?php if(isset($listdata->bowling)) { 
                        for($i=0;$i<count($listdata->bowling);$i++){
                             echo "<ul>";
                             if(isset($listdata->bowling[$i]->name)) 
                             {
                               echo "<li> Name :".$listdata->bowling[$i]->name."</li>";
                            }
                            if(isset($listdata->bowling[$i]->points)) 
                            {
                               echo "<li> Points :".$listdata->bowling[$i]->points."</li>";
                            }
                            
                            echo "</ul>";
                        }
                        }else{ echo "No bowling Data Found"; } ?></td>

                        <td>
                            <?php if(isset($listdata->catching)) { 
                        for($i=0;$i<count($listdata->catching);$i++){
                             echo "<ul>";
                             if(isset($listdata->catching[$i]->name)) 
                             {
                               echo "<li> Name :".$listdata->catching[$i]->name."</li>";
                            }
                            if(isset($listdata->catching[$i]->points)) 
                            {
                               echo "<li> Points :".$listdata->catching[$i]->points."</li>";
                            }
                            
                            echo "</ul>";
                        }
                        }else{ echo "No catching Data Found"; } ?></td>   
                        
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


