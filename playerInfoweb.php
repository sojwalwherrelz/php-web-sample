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
            <th>Photo</th>
            <th>Player Name</th>
            <th>Country</th>
            <th>DOB</th>
            <th>Role</th>
            <th>Batting Style</th>
            <th>Bowling Style</th>
            <th>Place Birth</th>
            <th>Place Stats</th>
        </tr>
        </thead>
         <tbody>
                <?php
                    $playerList  = array();
                    $id          = '77da5a6d-7c67-4a76-9d24-709ba6e5e1d8';
                    $apikey      = "%APIKEY%";
                    $json_result = file_get_contents('https://api.cricapi.com/v1/players_info?apikey='.$apikey.'&offset=0&id='.$id);
                    $series_search_data = json_decode($json_result);    
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $playerList[] = $series_search_data->data;
                    }
                    if(!empty($playerList)){
                        foreach($playerList as $list){
                    ?>
                    <tr>
                     <td><?php if(isset($list->playerImg)) { echo "<img width='100' height='100' src=".$list->playerImg.">"; }else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->name)) { echo $list->name; }else{ echo "No name Found"; } ?></td>
                        <td><?php if(isset($list->country)) { echo $list->country;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->dateOfBirth)) { echo $list->dateOfBirth;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->role)) { echo $list->role;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->battingStyle)) { echo $list->battingStyle;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->bowlingStyle)) { echo $list->bowlingStyle;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->placeOfBirth)) { echo $list->placeOfBirth;}else{ echo "No status Found"; } ?></td>
                        <td><?php if(isset($list->stats)) { 
                            for($i=0;$i<count($list->stats);$i++){   
                                echo "<ol>";
                                echo "<li>".$list->stats[$i]->fn."<li>";
                                echo "<li>".$list->stats[$i]->matchtype."<li>";
                                echo "<li>".$list->stats[$i]->stat."<li>";
                                echo "<li>".$list->stats[$i]->value."<li>";
                                echo "</ol>";
                            }   
                        }else{ echo "No status Found"; } ?></td>
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


