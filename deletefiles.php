<?php
$Key=hash('sha256',$_POST['key']);
// print_r($Key);
$KeyOnServer=file_get_contents('delkey.txt');
//print_r($KeyOnServer);
if($Key===$KeyOnServer){
    // Set the current working directory 
    $directory = getcwd()."/uploadedfiles/"; 
    // Returns array of files 
    $files1 = scandir($directory); 
    // Count number of files and store them to variable 
    $num_files = count($files1) - 2; 
    // specified folder 
    $files = glob($directory.'/*');  
    // Deleting all the files in the list
    if($num_files==0){
        echo'<center><h1>I found No files to delete!</h1></center><br><center><a href="index.html">Upload More</a>';
    }else{
        foreach($files as $file) { 
            if(is_file($file))  
                // Delete the given file 
                unlink($file);  
        } 
        echo '<center><h1>I have deleted '.$num_files . ' files!</h1></center><br><center><a href="index.html">Upload More</a>'; 
    } 
}else{
    die('<center><h1>Incorrect Key!</h1></center><br><center><a href="del.html">Try Again</a>');
}
?>