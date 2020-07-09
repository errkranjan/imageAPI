<?php
$domain='https://engineeringconcepts.in';
$Key=hash('sha256',$_POST['key']);
// print_r($Key);
$KeyOnServer=file_get_contents('key.txt');
//print_r($KeyOnServer);
if($Key===$KeyOnServer){
    // Count # of uploaded files in array
    $total = count($_FILES['upload']['name']);
    $Output['Links']=array();
    $CombinedLinks='';
    // Loop through each file
    for( $i=0 ; $i < $total ; $i++ ) {

    //Get the temp file path
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    //Make sure we have a file path
        $temp = explode(".", $_FILES["upload"]["name"][$i]);
        $newfilename = str_replace(' ','_',$_FILES["upload"]["name"][$i].round(microtime(true)) . '.' .end($temp));
        if(move_uploaded_file($_FILES["upload"]["tmp_name"][$i] , "./uploadedfiles/". $newfilename)){
            array_push($Output['Links'],$domain."/imageAPI/uploadedfiles/".$newfilename);
            $CombinedLinks=$CombinedLinks.$domain."/imageAPI/uploadedfiles/".$newfilename." | ";
        }else{
            die("Couldn't Generate Links!");
        }
    }
    echo 'Combined Delimiter Links<br/><textarea rows="18" cols="150">'.rtrim($CombinedLinks,'| ').'</textarea>';
    echo '<br/>JSON Link<br/><textarea rows="18" cols="150">'.json_encode(array($Output)).'</textarea><br><center><a href="index.html">Upload More</a>';
}else{
    die("<center><h1>Incorrect Key!</h1></center>");
}
?>