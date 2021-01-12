<?php
namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Validation\UserValidation;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class AccountController extends AbstractController {
    /**
     * @Route("/myaccount", name="app_account")
     */
    public function myaccount(Request $request) : Response {
        if($request->getSession()->get('isLoggedIn') === true) {
            $username = ($request->getSession()->get('user'))->getUsername();

            $userRepository = $this->getDoctrine()->getManager()->getRepository('App:User');
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
        $entityManager = $this->getDoctrine()->getManager();
        $userRepository = $entityManager->getRepository('App:User');
        $cityRepository = $entityManager->getRepository('App:City');
        $countryRepository = $entityManager->getRepository('App:Country');
        $user = $request->getSession()->get('user');

        $qb = $userRepository->createQueryBuilder('user');

        $qb->select('user.address', 'user.email', 'user.firstName', 'user.lastName', 'user.phone',
            'user.username', 'user.password', 'ci.name as city', 'cou.name as country' )
            ->innerJoin('App\Entity\City', 'ci', Join::WITH, 'ci.cityId = user.city')
            ->innerJoin('App\Entity\Country', 'cou', Join::WITH, 'cou.countryId = ci.country')
            ->where('user.username = \''. $user->getUsername() .'\'');

        $userDTO = $qb->getQuery()->getResult();
        $error = null;

        if(UserValidation::isValidUser($userRepository, $_POST)) {
            // update username
            if (!empty($_POST['username'])) {
                $qb->delete()->where('user.username = \'' . $user->getUsername() . '\'');
                $qb->getQuery()->getResult();

                $user->setUsername($_POST['username']);
                $userDTO[0]['username'] = $_POST['username'];

                $newUser = new User();
                $newUser->setUsername($_POST['username']);
                $newUser->setCity($cityRepository->findOneBy(['name' => $userDTO[0]['city']]));
                $newUser->setAddress($userDTO[0]['address']);
                $newUser->setEmail($userDTO[0]['email']);
                $newUser->setFirstName($userDTO[0]['firstName']);
                $newUser->setLastName($userDTO[0]['lastName']);
                $newUser->setPassword($userDTO[0]['password']);
                $newUser->setPhone($userDTO[0]['phone']);

                $entityManager->persist($newUser);
                $entityManager->flush();

                $user = $userRepository->findOneBy(['username' => $_POST['username']]);
            }
            // update password
            if (!empty($_POST['password'])) {
                $qb->update('App:User', 'user')
                    ->set('user.password', $_POST['password'])
                    ->where('user.username = ?1')
                    ->setParameter(1,  $user->getUsername())
                    ->getQuery()->execute();
            }
            // update first name
            if (!empty($_POST['firstName'])) {
                $qb->update('App:User', 'user')
                    ->set('user.firstName', $qb->expr()->literal($_POST['firstName']))
                    ->where('user.username = ?1')
                    ->setParameter(1, $user->getUsername())
                    ->getQuery()->execute();
            }
            // update last name
            if (!empty($_POST['lastName'])) {
                $qb->update('App:User', 'user')
                    ->set('user.lastName', $qb->expr()->literal($_POST['lastName']))
                    ->where('user.username = ?1')
                    ->setParameter(1, $user->getUsername())
                    ->getQuery()->execute();
            }
            // update address
            if (!empty($_POST['address'])) {
                $qb->update('App:User', 'user')
                    ->set('user.address', $qb->expr()->literal($_POST['address']))
                    ->where('user.username = ?1')
                    ->setParameter(1, $user->getUsername())
                    ->getQuery()->execute();
            }
            // update phone
            if (!empty($_POST['phone'])) {
                $qb->update('App:User', 'user')
                    ->set('user.phone', $qb->expr()->literal($_POST['phone']))
                    ->where('user.username = ?1')
                    ->setParameter(1, $user->getUsername())
                    ->getQuery()->execute();
                //return $this->render("test.html.twig", ['phone' => $_POST['phone']]);
            }
            // update email
            if (!empty($_POST['email'])) {
                $qb->update('App:User', 'user')
                    ->set('user.email', $qb->expr()->literal($_POST['email']))
                    ->where('user.username = ?1')
                    ->setParameter(1, $user->getUsername())
                    ->getQuery()->execute();
            }
            // update country
            if(!empty($_POST['country'])) {
                $country = $countryRepository->findOneBy(['name' => $_POST['country']]);
                if($country == null) {
                    $cQB = $countryRepository->createQueryBuilder('cou');
                    $count = $cQB->select('count(cou.countryId)')
                        ->getQuery()->getSingleScalarResult();

                    $country = new Country();
                    $country->setCountryId($count + 1);
                    $country->setName($_POST['country']);

                    $entityManager->persist($country);
                    $entityManager->flush();
                }
                $country = $countryRepository->findOneBy(['name' => $_POST['country']]);
            } else $country = $countryRepository->findOneBy(['name' => $userDTO[0]['country']]);
            // update city
            if(!empty($_POST['city'])){
                $city = $cityRepository->findOneBy(['name' => $_POST['city']]);
                if($city == null) {
                    $cQB = $cityRepository->createQueryBuilder('ci');
                    $count = $cQB->select('count(ci.cityId)')
                        ->getQuery()->getSingleScalarResult();

                    $city = new City();
                    $city->setName($_POST['city']);
                    $city->setCityId($count + 1);
                    $city->setCountry($country);

                    $entityManager->persist($city);
                    $entityManager->flush();
                }
                $city = $cityRepository->findOneBy(['name' => $_POST['city']]);
            } else $city = $cityRepository->findOneBy(['name' => $userDTO[0]['city']]);
            $user->setCity($city);
        } else $error = 'Invalid data inserted';

        $qb->update('App:User', 'user')
            ->set('user.city', '?1')
            ->where('user.username = ?2')
            ->setParameter(1, $user->getCity())
            ->setParameter(2, $user->getUsername())
            ->getQuery()->execute();

        $qb = $userRepository->createQueryBuilder('u');
        $qb->select('u.address', 'u.email', 'u.firstName', 'u.lastName', 'u.phone',
            'u.username', 'ci.name as city', 'cou.name as country' )
            ->innerJoin('App\Entity\City', 'ci', Join::WITH, 'ci.cityId = u.city')
            ->innerJoin('App\Entity\Country', 'cou', Join::WITH, 'cou.countryId = ci.country')
            ->where('u.username = \''. $user->getUsername() .'\'');

        $userDTO = $qb->getQuery()->getResult();

        $request->getSession()->set('user', $user);

        return $this->render("myaccount/myaccount.html.twig", [
            'user' => $userDTO[0],
            'error' => $error
        ]);
    }
}