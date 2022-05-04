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
            <th>Player Name</th>
            <th>Country</th>
        </tr>
        </thead>
        <tbody>
        <?php
                    $playerList  = array();
                    $search      = 'Nathan Le Tissier';
                    $search      = str_replace(' ', '%20', $search);
                    $apikey      = "%APIKEY%";
                    $json_result = file_get_contents('https://api.cricapi.com/v1/players?apikey='.$apikey.'&offset=0&search='.$search);
                    $series_search_data = json_decode($json_result);    
                    if($series_search_data->status != "success") {
                        die("FAILED TO GET A SUCCESS RESULT");
                    }
                    if(!empty($series_search_data)){
                        
                        $playerList[] = $series_search_data->data;
                    }
                    if(!empty($playerList)){
                        foreach($playerList as $list){
                            foreach($list as $listdata){  
                    ?>
                    <tr>
                        <td><?php if(isset($listdata->name)) { echo $listdata->name; }else{ echo "No name Found"; } ?></td>
                        <td><?php if(isset($listdata->country)) { echo $listdata->country;}else{ echo "No status Found"; } ?></td>
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


