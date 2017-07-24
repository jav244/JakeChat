<?php
include_once('LanguageParser.php');



class getHtml
{
  protected $locale;
  protected $db;
  protected $usrName;

  public function __construct($locale, $db, $usrName){
    $this->locale = $locale;
    $this->db = $db;
    $this->usrName = $usrName;
  }

   public function HtmlStructure()
   {
    $translator = new LanguageParser($this->locale);

    $header = 'Jake Chat';
    $loading = 'LOADING';
    $placeholder = 'Type a message';
    $send = 'Send';
    $login = 'Login';
    $register = 'Register';
    $enterUserName = 'Enter user name';
    $enterPassword = 'Enter password';
    $enterAUserName = 'Enter a user name';
    $enterAPassword = 'Enter a password';
    $enterAEmail = 'Enter an email';
    $logout = 'logout';



    $html ='<h3>' . $translator->translateSentence($header) . '</h3>';
    $html .= '<div id="data" >' . $translator->translateSentence($loading) . '...</div>';
    
    $html .= '<div id="messageBox">';
    //if($this->usrName != ''){
    //      $html .= '<div id = "loginName"> Logged in as ' . $this->usrName . '</div>';
    //}
    $html .= '<input type="text" id="input" onkeypress="checkForEnter(event, this)" placeholder="'. $translator->translateSentence($placeholder) .'..." />';
    $html .= '<button id="submitMsg" class="btn btn-default">' . $translator->translateSentence($send) . '</button><br>';
    $html .= '</div>';

    $html .= '<div id = "loginRegister">';
    $html .= '<button id="loginButton" class="btn btn-default">' . $translator->translateSentence($login) . '</button> ';
    $html .= '<button id="registerButton" class="btn btn-default">' . $translator->translateSentence($register) . '</button>';
    $html .= '</div>';

    $html .= '<div id="loginForm">';
    $html .= $translator->translateSentence($enterUserName) . ': <input id ="loginUsrName" type ="text" /> <br><br>';
    $html .= $translator->translateSentence($enterPassword) . ': <input id ="loginPassword" type ="password" /> <br><br>';
    $html .= '<button id="loginBtn" class="btn btn-default">' . $translator->translateSentence($login) . '</button>';
    $html .= '</div>';

    $html .= '<div id="registerForm">';
    $html .= $translator->translateSentence($enterAUserName) . ': <input id ="registerUsrName" type ="text" /> <br><br>';
    $html .= $translator->translateSentence($enterAPassword) . ': <input id ="registerPassword" type ="password"/> <br><br>';
    $html .= $translator->translateSentence($enterAEmail) . ': <input type="email" id="registerEmail"/> <br><br>';
    $html .= '<button id="registerBtn" class="btn btn-default">' . $translator->translateSentence($register) . '</button>';
    $html .= '</div>';
    $html .= '<br>';
    $html .= '<button id="logoutBtn" class="btn btn-default">'. $translator->translateSentence($logout) .'</button><br><br>';

    $html .= '<button class="btn btn-xs" id="ma" onclick="changeLocale(this), window.location.reload()">Maori</button>';
    $html .= '<button class="btn btn-xs" id="en" onclick="changeLocale(this), window.location.reload()">English</button>';
    $html .= '<button class="btn btn-xs" id="kw" onclick="changeLocale(this), window.location.reload()">KiwiSpeak</button>';


    /*$html = '
      <h3>Jake Chat</h3>
        <div id="data" >
          LOADING...
        </div>

        <div id="messageBox">
          <input type="text" id="input" onkeypress="checkForEnter(event, this)" placeholder="Type a message..." />
          <button id="submitMsg" class="btn btn-default">Send</button><br>
        </div>

        <div id = "loginRegister">
          <button id="loginButton" class="btn btn-default">Login</button> 
          <button id="registerButton" class="btn btn-default">Register</button>
        </div>

        <div id="loginForm">
            Enter user name: <input id ="loginUsrName" type ="text" />
            <br><br> 
            Enter password: <input id ="loginPassword" type ="password" />
            <br><br>
            <button id="loginBtn" class="btn btn-default">Login</button>
        </div>

        <div id="registerForm">
          Enter a user name: <input id ="registerUsrName" type ="text"/>
            <br><br> 
          Enter a password: <input id ="registerPassword" type ="password"/>
            <br><br>
          Enter a email: <input type="email" id="registerEmail"/>
          <button id="registerBtn" class="btn btn-default">Register</button>
        </div>    
      <br>
      <button id="logoutBtn" class="btn btn-default">logout</button>';*/
    return $html;
   }







}



?>