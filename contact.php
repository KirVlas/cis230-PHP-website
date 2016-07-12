<?php
$page_title = "Contact Us";
require "includes/head.php";

$first = $last = $mail = $phone = $comments = $contact = $news = $choice = "";
$error1 = "";
$error2 = "";
$checked1 = "";
$checked2 = "";
$checked_news = "";
$no_selection = "";
$events = "";
$promotions = "";
$projects = "";

if (isset($_POST['submit'])) {
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];
    $contact = $_POST['contact'];
    $news = $_POST['news'];
    $choice = $_POST['choice'];
    $submit = $_POST['submit'];
    if ($first === "") {
        $error1 = 'Please enter first name.';
    } else {
        $error1 = "";
    }

    if ($last === "") {
        $error2 = 'Please enter last name.';
    } else {
        $error2 = "";
    }

    if ($email === ""){
        $error3 = 'Please enter email';
    }else{
        $error3 = "";
    }

    if ($contact == "email") {
        $checked1 = 'checked="checked"';
    } elseif ($contact == "phone") {
        $checked2 = 'checked="checked"';
    } else {
        $checked1 = "";
        $checked2 = "";
    }

    if ($news == "news") {
        $checked_news = 'checked="checked"';
    } else {
        $checked_news = "";
    }

    if ($choice == "no_selection") {
        $no_selection = 'selected="selected"';
    } elseif ($choice == "events") {
        $events = 'selected="selected"';
    } elseif ($choice == "promo") {
        $promotions = 'selected="selected"';
    } elseif ($choice == "projects") {
        $projects = 'selected="selected"';
    }

    if ($error1 == "" && $error2 == "" && $error3 == ""){
        $to = $email;
        $subject= "You sent a message to RLPP.";
        $message = "We received your message and will get back to you as soon as possible. \n\r";
        $message .= "Here is the information that has been sent to us: \n\r";
        $message .= "First Name: $first\n\r";
        $message .= "Last Name: $last\n\r";
        $message .= "Email: $email\n\r";
        $message .= "Phone: $phone\n\r";
        $message .= "Comments: " . wordwrap($comments, 100) . "\n\r";
        $message .= "Contact me by: $contact\n\r";
        $message .= "Receive the newsletter?: ";
        if ($news == "news") {
            $message .= "Yes\n\r";
        }else {
            $message .= "No\n\r";
        }
        $message .= "Would like more information about?: $choice\n\r";
        mail($to, $subject, $message, $headers);

        $confirm = "Message sent!";

        $first = "";
        $last = "";
        $email = "";
        $phone = "";
        $comments = "";
        $choice = "";

    }else {
        $confirm = "";
    }
}







$my_form = <<< EOF
<section id="main_content">
    <h2>$confirm</h2>
    <form method="POST" action="contact.php" class="contact">
        <fieldset>
            <legend>Contact Info: </legend>
            <span>* Required field</span><br/>
            <input type="text" name="first" id="first" placeholder="First Name" value="$first"><span>&nbsp;*</span><span class="error_msg">&nbsp;$error1</span><br/>
            <input type="text" name="last" id="last" placeholder="Last Name" value="$last"><span>&nbsp;*</span><span class="error_msg">&nbsp;$error2</span><br/>
            <input type="text" name="email" id="email" placeholder="Email" value="$email"><span>&nbsp;*</span><span class="error_msg">&nbsp;$error3</span><br/>
            <input type="text" name="phone" id="phone" placeholder="Phone" value="$phone"><br/>
            <input type="checkbox" name="news" value="news" $checked_news> I would like to receive the newsletter!
        </fieldset><br/>
        <fieldset>
            <legend>I would like to be contacted by: </legend>
            <input type="radio" name="contact" value="Email" $checked1>Email
            <input type="radio" name="contact" value="Phone" $checked2>Phone
        </fieldset><br/>
        <fieldset>
            <legend>I would like more information about: </legend>
            <select name="choice">
                <option value="no_selection" $no_selection>No Selection</option>
                <option value="Events" $events>Events</option>
                <option value="Promotions" $promotions>Promotions</option>
                <option value="Projects" $projects>Projects</option>
            </select>
        </fieldset><br/>
        <fieldset>
            <textarea rows="5" cols="50" name="comments" placeholder="Enter your comments">$comments</textarea>
        </fieldset>
        <input type="submit" name="submit" class="button">
    </form>
</section>

EOF;

echo $my_form;

require "includes/footer.php";
?>