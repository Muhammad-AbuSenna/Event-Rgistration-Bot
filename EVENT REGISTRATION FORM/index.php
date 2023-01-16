<?php
/*
Please check these linkes to know how to connect your orchestrator with external applications:
- about external apps: https://docs.uipath.com/automation-cloud/docs/about-external-applications
- Managing external applications: https://docs.uipath.com/automation-cloud/docs/managing-external-applications
- Accessing UiPath resources using external applications: https://docs.uipath.com/automation-cloud/docs/setting-up-the-external-application
this app is registered on orchestrator as a confidential application type and uses application scope   
*/
  $name = $email = $phone = $address = $spamProtection = '';
  $errors = ['name' => '', 'email' => '', 'phone' => '', 'address' => '', 'spamProtection' => ''];

  if(isset($_POST['submit'])){

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $spamProtection = str_replace(" ","",strtolower(htmlspecialchars($_POST['spamProtection'])));


    //Name check
    if(empty($name)){
      $errors['name'] = ' - You must provide your name.';
    }else{
      if(!preg_match('/^([A-Za-z\s*]+)$|^[\x{0600}-\x{06FF}\s*]+$/u', $name)){
        $errors['name'] = ' - You must provide a valid name.';
      }
    }
    
    //Email check
    if(empty($email)){
      $errors['email'] = ' - You must provide your Email address to receive your invitation on.';
    }else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = ' - You must provide a valid email.';
      }
    }

    //Phone check
    if(empty($phone)){
      $errors['phone'] = ' - You must provide your phone.';
    }else{
      if(!preg_match('/^\+*[0-9]{10,13}$/', $phone)){
        $errors['phone'] = ' - You must provide a valid phone number.';
      }
    }

    //spam protection check
    if(empty($spamProtection)){
      $errors['spamProtection'] = ' - You must answer this question.';
    }else{
      if(!($spamProtection == 'july10th')){
        $errors['spamProtection'] = ' - wrong answer.';
      }
    }

    //check for any errors
    if(!array_filter($errors)){

      //--------------------------------ORCHESTRATOR API CONNECTION----------------------------------

      require 'Orchestrator_API_OAuth.php';
      require 'add_queue_item.php';
      require 'constants.php';

      $request_OAuth = new OAuth();
      $request_OAuth->set_endpoint(_OAuth_endpoint);
      $request_OAuth->set_client_id(_client_id);
      $request_OAuth->set_client_secret(_client_secret);
      $request_OAuth->set_scope(_scope);
      $access_token = $request_OAuth->get_OAuth();

      $new_Queue_item = new Queue_item();
      $new_Queue_item->set_endpoint(_add_queue_item_endpoint);
      $new_Queue_item->set_UnitId(_UnitId);
      $new_Queue_item->set_access_token($access_token);
      $new_Queue_item->set_Queue_name(_Queue_name);
      $new_Queue_item->set_user_name($name);
      $new_Queue_item->set_email($email);
      $new_Queue_item->set_phone($phone);
      $new_Queue_item->set_address($address);
      $new_Queue_item->add_queue_item();

      header('Location: successfulSubmission.php');

      /*
      //--------------------------------DATABASE OPERATIONS------------------------------------------
      //connecting to the database
      $conn = mysqli_connect('localhost', 'mnaeem', 'test2022','invitationdb');

      if(!$conn){
        echo 'Connection error: '.mysqli_connect_error();
      }

      //write query to insert user data.
      $sql = "INSERT INTO user(user_name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address' )";

      //excute query and check
      if(mysqli_query($conn, $sql)){
        header('Location: successfulSubmit.php');
      }else{
        echo 'query error: '. mysqli_error($conn);
      };

      //close the connection
      mysqli_close($conn);
      */
      
    }

  }
  
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event regestration</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="contact-us">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

      <label for="userName">
        NAME
        <span class = "validation_errors"><?php echo htmlspecialchars($errors['name']);?></span>
         <em>&#x2a;</em>
      </label>
      <input id="userName" name="name"  type="text" placeholder = "Full Name" Value = "<?php echo $name; ?>" />
      
	  
      <label for="userEmail">
        EMAIL
        <span class = "validation_errors"><?php echo htmlspecialchars($errors['email']);?></span> 
        <em>&#x2a;</em>
      </label>
      <input id="userEmail" name="email"  type="email" placeholder = "example@domain.com" Value = "<?php echo $email; ?>"/>
      

      <label for="userPhone">
        PHONE
        <span class = "validation_errors"><?php echo htmlspecialchars($errors['phone']);?></span>
        <em>&#x2a;</em>
      </label>
      <input id="userPhone" name="phone"  pattern="[0-9]{11}" placeholder="Ex: 01234567891" type="tel" Value = "<?php echo $phone; ?>" />
      

      <label for="address">ADDRESS</label>
      <input id="address" name="address" type="address" Value = "<?php echo $address; ?>"/>

      <label for="spamProtection">
        SPAM PROTECTION
        <em>&#x2a; </em>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;What day comes before July 11th?</span>
        <span class = "validation_errors"><?php echo htmlspecialchars($errors['spamProtection']);?></span >
      </label><input id="spamProtection" name="spamProtection" type="text"/>
      

      <button id="submitBtn" type = "submit" name = "submit">SUBMIT</button>

    </form>
  </div>
</body>

</html>