<?php 
include_once "scramblerf.php";
$task = 'encode';
if(isset($_GET['task']) && $_GET['task'] != '' ){
    $task = $_GET['task'];
}
$original_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
$key = 'abcdefghijklmnopqrstuvwxyz1234567890';
if ( 'key' == $task ) {
	$key_original = str_split( $key );
	shuffle( $key_original );
	$key = join( '', $key_original );
}else if(isset($_POST['key']) && $_POST['key']!=''){
    $key = $_POST['key'];
}


$scrambledData = '';
if('encode' == $task){
    $data = $_POST['data']??'';
    if($data != ''){
        $scrambledData = scrambleData($data, $key);
    }
}

if('decode' == $task){
	$data = $_POST['data']??'';
	if($data != ''){
		$scrambledData = decodeData($data, $key);
	}
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Data Scramble</title>
</head>

<body>
    <div class="container mt-4">

        <div class="alert alert-success d-flex justify-content-center" role="alert">
            <h3>Data Scramble</h3>
        </div>

        <div class="alert alert-primary d-flex justify-content-center" role="alert">

            <div>
                <a href="scrambler.php?task=encode" class=".text-success">Encode</a> |
                <a href="scrambler.php?task=decode" class="text-danger">Decode</a> |
                <a href="scrambler.php?task=key" class=".text-warning">Generate Key</a>
            </div>

        </div>


        <form class="border border-danger p-4" method="POST"  action="scrambler.php<?php if('decode'== $task) { echo "?task=decode"; } ?>">
            <div class="form-group">
                <label for="key">Key</label>
                <input type="text" class="form-control" name="key" id="key" <?php displayKey($key)?> >
            </div>


            <div class="form-group">
                <label for="data">Data</label>
                <textarea class="form-control" name="data" id="data" rows="3"><?php if(isset($_POST['data'])) { echo $_POST['data']; } ?></textarea>
            </div>

            <div class="form-group"> 
                <label for="data">Result</label>
                <textarea class="form-control" name="result" id="result" rows="3"><?php echo $scrambledData; ?></textarea>
            </div>



            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-success">Hit Me !!</button>
            </div>

        </form>
    </div>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>