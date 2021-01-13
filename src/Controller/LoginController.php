<?php
namespace App\Controller;
use Doctrine\ORM\Query\Expr\Join;
use phpDocumentor\Reflection\Types\This;
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
        return $this->render('myaccount/login.html.twig', []);
    }

    /**
     * @Route("/submitLogin", name="app_submit_login")
     */
    public function submitLogin(Request $request) : Response {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userRepository = $this->getDoctrine()->getRepository('App:User');
        $user = $userRepository->findOneBy(['username' => $username]);
        if($user == null || $user->getPassword() !== $password) {
            $error = "Invalid username or password";
            return $this->render("myaccount/login.html.twig", [
                'error' => $error
            ]);
        }

        $request->setSession($this->session);
        $request->getSession()->start();

        $request->getSession()->set('isLoggedIn', true);
        $request->getSession()->set('user', $user);
        return $this->redirect("/myaccount");
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register() {
        return $this->render('myaccount/register.html.twig', []);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request) {
        $request->getSession()->set('addedBooks', null);
        $request->getSession()->invalidate();
        return $this->redirect("/login");
    }
}