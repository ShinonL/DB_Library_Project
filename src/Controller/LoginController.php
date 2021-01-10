<?php
namespace App\Controller;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LoginController extends AbstractController {
    private $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login() : Response {
        if(!isset($_GET['action']))
            $_GET['action'] = '';
        $error = null;

        switch($_GET['action']) {
            case '':
                return $this->render('myaccount/login.html.twig', [
                    'error' => $error
                ]);
            case 'validate':
                $_SESSION['username'] = $_POST['username'];

                $user = $this->getDoctrine()->getRepository('App:User')->findBy(['username' => $_SESSION['username']]);
                if($user != null && $user[0]->getPassword() == $_POST['password']) {
                    $this->session->set('username', 'password');
                    return $this->render('myaccount/myaccount.html.twig', [
                        'user' => $user[0]
                    ]);
                }
                else {
                    $error = 'Invalid username or password';
                    return $this->render('myaccount/login.html.twig', [
                        'error' => $error
                    ]);
                }
            default: {
                return $this->render('myaccount/login.html.twig', [
                    'error' => $error
                ]);
            }
        }
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register() {
        return $this->render('myaccount/register.html.twig', []);
    }
}