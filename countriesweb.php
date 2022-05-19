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
            <th>Flags Image</th>
            
        </tr>
        </thead>
        <tbody>
        <?php
        $countriesList  = array();
        $maxOffset   = 1;
        $apikey      = "%APIKEY%";
        $json_result = file_get_contents('https://api.cricapi.com/v1/countries?apikey='.$apikey.'&offset=0');
        $countriesdata = json_decode($json_result);
        if($countriesdata->status != "success") {
            die("FAILED TO GET A SUCCESS RESULT");
        }
        if(!empty($countriesdata)){
                
            $countriesList[] = $countriesdata->data;
        }

       
        ?>
        <?php 
        if(!empty($countriesList)){
            foreach($countriesList as $list){
            foreach($list as $val){
        ?>
        <tr>
            <td><?php echo $val->name; ?></td>
            <td><?php if(isset($val->genericFlag)) { echo "<img width='100px' height='100px' src=".$val->genericFlag.">"; }else{ echo "No matches Data Found" ; } ?></td>
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


