<?php

require '../../data-config.php';

  $user_ID = $_POST['user_ID'];     
  $logo = $_POST['logo'];   
  $logo_local_source = $_POST['logo_local_source'];

  $date = date("Ymd");  
  $filename = "IMG" . $date . rand() . ".jpg";

  $fullPath = "images/logo/" . $filename;
  
  if(!empty($logo))
    {
        file_put_contents("images/logo/" . $filename, base64_decode($logo));
    } 
  
  $query =  "select * from g12_image_uploaded where user_ID = $user_ID AND upload_type='church-logo'";
            $result = $conn->query($query);
            
            if($result->num_rows >0)
                { 
                            while($row = $result->fetch_assoc()) 
                                {                            
                                  if(!empty($row['server_image_source'])) 
                                      {
                                          unlink($row['server_image_source']);
                                      }                             
                                }
                }
                
  $query = "DELETE from g12_image_uploaded where user_ID = $user_ID AND upload_type='church-logo'";  
            $result = $conn->query($query);            
  
  $query = "INSERT INTO g12_image_uploaded (user_ID, upload_type, server_image_source,local_image_source, createdBy) VALUES ($user_ID, 'church-logo','$fullPath','$logo_local_source', $user_ID);";
            $result = $conn->query($query);
            
  echo "Church Logo upload successfully!";          
  
?>