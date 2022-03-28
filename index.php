<?php
 
session_start();
 
if(isset($_GET['logout'])){    
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
 
function loginForm(){
    echo
    '<div id="loginform">
    <p>Please enter your name to continue!</p>
    <form action="index.php" method="post">
      <label for="name">Name &mdash;</label>
      <input type="text" name="name" id="name" />
      <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
  </div>';
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/png" href="img/flipai.png"/>
	<title>DnD Chat</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
</head>
<body>
<div class="tab" style="text-align:center">
    <button class="tablinks" onClick="openUs(event, 'Home')">Home</button>
    <button class="tablinks" onClick="openUs(event, 'Back')">Go Back to the DnD Page</button>
    </div>
    <div if="Back" class='tabcontent'>
        <div>
            <a rel="back" href="dnd.html">Click here to return to the DnD page.</a>
            <p>--------------------------------</p>
        </div>
    </div>
    <div id="Chat" class='tabcontent'>
      <div>
        <a rel="chat" href="https://oneenterprisestech-chat.herokuapp.com/index.php" target="_blank">Click here to access the live chat in a new tab.</a>
      </div>
      <div>
      <p>---------------------------------------</p>
      </div>
    </div>
    <div id="Research" class='tabcontent'>
      <a rel="research" href="researchindex.html">Click here to return to the Research Pages Index.</a>
      <p>--------------------------------------</p>
    </div>
    </div>
    <div id="Home" class='tabcontent'>
      <a rel="home" href="index.html">Click here to go back to the homepage</a>
                <p>-----------------------------------------</p>
    </div>
    <div id="Notes" class='tabcontent'>
      <a rel="notes" href="https://oneenterprisestech.github.io/SchoolHelp/notehelper.html">Click here to view the notes (for schooling)</a>
          <p>-----------------------------------------</p>
    </div>
    <div id="Support" class='tabcontent'>
      <a rel="suport" href="https://www.bonfire.com/the-systems/" target="_blank">Click here to support us!</a>
          <p>-----------------------------------------</p>
    </div>
    <div id="CalcCheats" class='tabcontent'>
      <a rel="calccheats" type="text/html" href="https://oneenterprisestech.github.io/TI8483CheatsandHelps/">Click here to view the calculator cheats page</a>
          <p>-----------------------------------------</p>
    </div>
    <div id="SitesList" class='tabcontent'>
      <a rel="directive" type="text/html" href="sites_list.html">Click here to get redirected to the directory</a>
          <p>-----------------------------------------</p>
    </div>
    <div id="Changelog" class='tabcontent'>
    <a rel="changelog" type="text/html" href="changelog.html">Click here to view the Changelog</a>
    <p>-----------------------------------------</p>
  </div>
    <div id="FlipAI" class='tabcontent'> 
      <a type="text/html" href="main.html">Click here to get directed to the FlipAI website</a>
    <p>-----------------------------------------</p>
  </div>
    <div id="AboutUs" class='tabcontent'>
      <a type="text/html" href="about.html">Click here to get directed to the About Us page.</a>
      <p>-----------------------------------------</p>
    </div>
  <div>
    <div id="Music" class='tabcontent'>
      <a type="text/html" href="fileshiz.html">Click here to get directed to the Audio page (to download music)</a>
      <p>-------------------</p>
    </div>
  </div>
  <div>
    <div id="Tabs" class='tabcontent'>
      <a type="text/html" href="tabs.html">Click here to view/download some guitar tabs</a>
    </div>
  </div>
    <div>
      <div id="HowTo" class="tabcontent">
        <a type="text/html" href="htindex.html">Click here to view the How-To page</a>
	      <p>-----------------------</p>
      </div>
    </div>
      <script>
function openUs(evt, usType) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(usType).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
   <header>
    <div id="top-header">
      <div id="header-image-menu">
        <img src="img/banner.png">
    </div>
	   </div>
    </header>
	 <?php
    if(!isset($_SESSION['name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
 
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
 
                $("#exit").click(function () {
                    var exit = confirm("Are you sure you want to end the session (You may not be able to access your chat)?");
                    if (exit == true) {
                    window.location = "index.php?logout=true";
                    }
                });
            });
        </script>
	<script src="https://utteranc.es/client.js"
        repo="oneenterprisestech/oneenterprisestech.github.io"
        issue-term="title"
        label="Comment"
        theme="github-dark"
        crossorigin="anonymous"
        async>
</script>
<footer>
    &copy; 2022 OneEnterprises.Tech
  </footer>
</body>
</html>
<?php
}
?>
