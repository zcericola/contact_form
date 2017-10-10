<? php
    error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
    
    
    //Pulling values that were entered into the form.
$name = $_POST['visitorName'];
$email = $_POST['visitorEmail'];
$message = $_POST['visitorMsg'];

if(IsInjected($email))
{
    echo "Bad email value!";
    exit;
}
    

//Structure of email that I will receive with the form info
$email_from = "zcericola@gmail.com";
$email_subject = 'New Contact Form Message';
$email_body = "You have received a new message from $name. \n".
                "Here is the message: \n $message".
    
    

//Sending to my email address and using the mail function
    $to = "zcericola@gmail.com";
$header = "From: $email_from \r\n";
$header .= "Reply-To: $email \r\n";
mail($to,$email_subject,$email_body,$header);

//Validating the form
function IsInjected($str)
{
    $injections = array('(\n+)',
                        '(\r+)',
                        '(\t+)',
                        '(\%0A+)',
                        '(\%0D+)',
                        '(\%08+)',
                        '(\%09+)',
                        );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    
    if(preg_match($inject,$str))
    {
        return true;        
    }
    else
    {
        return false;
    }
                            
}







/?>

    <html lang='en'>
    <!--This will be displayed after the submit button is pressed. --->
    <h1>Your email has been sent. Thank-you!</h1>



    </html>
