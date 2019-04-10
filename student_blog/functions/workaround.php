<?

$(form_id).submit(function(){ //triggered when user submits form
  var signed_in = check_if_user_is_signed_in(); //checking
  if(signed_in){ //singed in
    //Do stuff
    return true; //submit form
  } else{ //user not signed in
    //Do stuff
    return false; //prevent form from being submitted
  }
})

?>