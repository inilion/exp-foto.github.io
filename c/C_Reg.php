<?
class C_Reg extends C_Base
{
//
// Конструктор.
//
public function __construct(){
parent::__construct();
}

public function before(){
parent::before();
}

public function action_login(){

$this->title .= '::Регистрация';
$mUsers = M_Users::Instance();
$mUsers->Logout();

if($this->isPost())
{
if($mUsers->Login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
$this->redirect('/');
}
$this->content = $this->Template('v/v_login.php');
}

public function action_logout(){
$this->title .= '::Регистрация';
$mUsers = M_Users::Instance();
$mUsers->Logout();

$this->redirect('/');
}

public function action_reg(){
$this->title .= '::Регистрация';
    $mUsers = M_Users::Instance();

    if($this->isPost()) {
        if (!empty($_POST['Firstname'])
            && (!empty($_POST['Mail'])
                && (!empty($_POST['Login'])
                    && (!empty($_POST['Pass'])
                        && (!empty($_POST['DublePass'])))))
        ) {

            $Firstname = htmlspecialchars(stripslashes($_POST['Firstname']));
            $Login = htmlspecialchars(stripslashes($_POST['Login']));
            $Pass = htmlspecialchars(stripslashes($_POST['Pass']));
            $DublePass = htmlspecialchars(stripslashes($_POST['DublePass']));
            $Mail = htmlspecialchars(stripslashes($_POST['Mail']));
            $mUsers = M_Users::Instance();

        } else {
            $_SESSION['error'] = 'Поле со звездочкой обязателно должно быть заполнено!';
            $_SESSION['Firstname'] = $_POST['Firstname'];
            $_SESSION['Login'] = $_POST['Login'];
            $_SESSION['Mail'] = $_POST['Mail'];
            header('Location: /reg/reg');
            exit;
        }

        if ($_POST['Pass'] !== $_POST['DublePass']) {

            $_SESSION['error'] = "Пароли не совпали!";

            header('Location: /reg/reg');
            exit;
        }
        $mUsers->AddUser($Firstname, $Login, $Pass, $Mail);
        header('Location: /');
    }
    $this->content = $this->Template('v/v_form_registration.php');
/////////////////////////////////////////
}
}
?>