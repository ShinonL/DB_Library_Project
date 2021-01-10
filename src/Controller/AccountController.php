<?php
namespace App\Controller;

use Doctrine\ORM\Query\Expr\Join;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController {
    /**
     * @Route("/myaccount", name="app_account")
     */
    public function myaccount(Request $request) : Response {
        if($request->getSession()->get('isLoggedIn') === true) {
            $username = ($request->getSession()->get('user'))->getUsername();

            $userRepository = $this->getDoctrine()->getRepository('App:User');
            $user = $userRepository->findOneBy(['username' => $username]);

            $qb = $userRepository->createQueryBuilder('user');

            $qb->select('user.address', 'user.email', 'user.firstName', 'user.lastName', 'user.phone',
                'user.username', 'ci.name as city', 'cou.name as country' )
                ->innerJoin('App\Entity\City', 'ci', Join::WITH, 'ci.cityId = user.city')
                ->innerJoin('App\Entity\Country', 'cou', Join::WITH, 'cou.countryId = ci.country')
                ->where('user.username = \''. $user->getUsername() .'\'');

            $userDTO = $qb->getQuery()->getResult();
            return $this->render("myaccount/myaccount.html.twig", [
                'user' => $userDTO[0]
            ]);
        }
        return $this->redirect("/login");
    }

    /**
     * @Route("/submitUpdate", name="app_submit_update")
     */
    public function update(Request $request) : Response {
        $userRepository = $this->getDoctrine()->getRepository('User');
        $user = $request->getSession()->get('user');

        $qb = $userRepository->createQueryBuilder('user');

        $qb->select('user.address', 'user.email', 'user.firstName', 'user.lastName', 'user.phone',
            'user.username', 'ci.name as city', 'cou.name as country' )
            ->innerJoin('App\Entity\City', 'ci', Join::WITH, 'ci.cityId = user.city')
            ->innerJoin('App\Entity\Country', 'cou', Join::WITH, 'cou.countryId = ci.country')
            ->where('user.username = \''. $user->getUsername() .'\'');

        $userDTO = $qb->getQuery()->getResult();



        return $this->redirect("/myaccount");
    }
}