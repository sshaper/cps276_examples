<?php
$msg = "";
$output = "";
//ISSET CHECKS TO SEE IF A VARIBLE EXISTS. RETURNS TRUE IF IT DOES AND FALSE IF IT DOES NOT. 
if(isset($_POST['create'])){
  $success = mkdir('parent/child/sub-child', 0777, true);
  
  /*NOT ALL SUBDIRECTORIES MAY NOT HAVE THE PROPER FILE PERMISSIONS SO I WILL MANUALLY SET THEM WITH CHMOD*/
  chmod('parent', 0777);
  chmod('parent/child', 0777);
  chmod('parent/child/sub-child', 0777);

  /*I WILL ALSO ADD SOME FILES TO THE CHILD SUB DIRECTORY*/
  $file = fopen("parent/child/child-file1.txt","w") or die("Cannot Open File");
  $content = "This is child file 1";
  fwrite($file,$content);
  fclose($file);


  /*I WILL ALSO ADD SOME FILES TO THE SUB-CHILD SUB DIRECTORY*/
  $file = fopen("parent/child/sub-child/file1.txt","w") or die("Cannot Open File");
  $content = "This is sub-child file 1";
  fwrite($file,$content);
  fclose($file);

  $file = fopen("parent/child/sub-child/file2.txt","w") or die("Cannot Open File");
  $content = "This is sub-child file 2";
  fwrite($file,$content);
  fclose($file);

  if($success){
    $msg = "Directories Created";
  }
  else{
    $msg = "There was a problem";
  }
  
}
if(isset($_POST['remove'])){
   
   $count = 0;

   

  /* THIS FUNCTION DEALS WITH DELETING DIRECTORIES, SUB DIRECTORIES AND FILE RECRUSIVELY */
  function delete_files($target) {
      global $output;

      /* IS_DIR() CHECKS TO SEE IF THE TARGET IS A DIRECTORY,*/
      if(is_dir($target)){
          


          /*GLOB RETURNS AN ARRAY CONTAINING THE MATCHED FILES/DIRECTORIES, AN EMPTY ARRAY IF NO FILE MATCHED OR FALSE ON ERROR.  IN THIS CASE GLOB RETURNS AND ARRAY OF ANY SUBFOLDERS OR FILES*/

          /*GLOB_MARK ADDS A SLASH TO EACH DIRECTORY. IF A SLASH WAS NOT ADDED THEN THE SUBDIRECTORY NAMES WOULD APPEAR TO BE PART OF THE PARENT DIRECTORY.  IF GLOB_MARK IS REMOVED YOU WILL GET AN INFINITE LOOP.*/
          $files = glob( $target . '*', GLOB_MARK );

          /*echo "<pre>";
          print_r($files);
          echo "</pre>";  */
                 
          
          /*THE FOREACH LOOPS THROUGH THE ARRAY RETURNED BY GLOB AND IF THEIR ARE ANY FILES IN THAT ARRAY IT WILL DELETE THEM BY CALLING DELETE FILE AGAIN.  IF THE ARRAY ONLY CONTAINS A DIRECTORY  IT WILL GET THE NEXT CHILD DIRECTORY */
          foreach( $files as $file ){
            $output .= "file per iteration is - ".$file."<br>";
            
            /* IF THIS IS A FILE THEN REMOVE IT OTHERWISE CHECK FOR ANOTHER SUB DIRECTORY AND IT BECOMES TARGET 

            IMPORTANT! NOTICE THAT IT IS CALLING DELETE_FILES AND PASSING THE NEXT ARRAY ITEM WHICH MAY BE A DIRECTORY OR FILE.  IF IT IS A FILE THEN IT WILL DELETE IT, BYPASSING IS_DIR.  ONCE A FILE IS DELETED IT GOES TO THE NEXT ARRAY ITEM.
            */
            delete_files($file);
          }

    
          /*
          I NEEDED TO DO A FINAL CHECK TO MAKE SURE THE TARGET WAS A DIRECTORY, BEFORE I WAS GETTING A WARNING THAT THE FILE DID NOT EXIST BECAUSE IT HAD CALLED DELETE_FILES PREVIOUSLY
          
          IMPORTANT! $TARGET IS JUST A PARAMETER (A PLACEHOLDER) THAT REPRESENTS SOMETHING NEW ON EVERY ITERATION.  IT IS NOT A VARIABLE TIED TO ONE VALUE.  SO WHEN ALL THE LOOPING IS DONE, THE DIRECTORY $TARGETS ARE REMOVED STARTING WITH THE LAST ONE FOUND, FIRST.
          */
          
          if(is_dir($target)){
            $output .= "Directory deleted is - ".$target."<br>";
            rmdir($target);
          }
      }

      /*IS_FILE CHECKS TO SEE IF THE TARGET IS A FILE AND IF SO REMOVES IT.*/
      elseif(is_file($target)) {
          $output .= "File deleted is - ".$target."<br>";
          unlink($target);  
      }
  }

  /*WE ARE CALLING DELETE FILES AND PASSING THE PARENT DIRECTORY (NAME 'PARENT') INTO THE FUNCTION, THIS STARTS THE PROCESS.*/
  delete_files('parent');
  

  /*THIS IS A FINAL CHECK.  FILE_EXISTS CHECKS TO SEE IF THE DIRECTORY OR FILE EXISTS*/
  if(!file_exists ('parent')){
    $msg = "Directories Removed";
  }
  else{
    $msg = "There was a problem";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Multiple Directory</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="public/css/main.css">
  <style>
  body {
    font: 250%/1.5 sans-serif;
  }
</style>
  </head>
  <body>
    <div id="wrapper" class="container">
      <h1>Multiple Directory</h1>
      <p><?php echo $msg; ?></p>
      <p>This example demonstrates how to create and remove multiple directories, sub directories and files.</p>
      <p>NOTE: In order for this to work the folder this file is in <code>php-directories</code> had to have permissions of 0777.</p>
      <form action="mult-directories.php" method="POST">
        <input type="submit" class="btn btn-primary" name="create" value="Create Multiple Directories">
        <input type="submit" class="btn btn-primary" name="remove" value="Remove Multiple Directories">
      </form>

      <?php echo $output; ?>
      
    </div>
    

  </body>
</html>