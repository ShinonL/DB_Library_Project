<?php
namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\User;
use App\Validation\UserValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController {
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request) {
        return $this->render("myaccount/register.html.twig", []);
    }

    /**
     * @Route("/submitRegister", name="app_submit_register")
     */
    public function submitRegister(Request $request) {
        $error = null;

        $entityManager = $this->getDoctrine()->getManager();
        $userRepository = $entityManager->getRepository('App:User');

        if(!UserValidation::isValidUsername($userRepository, $_POST['username'])) {
            $error = "Invalid username or username already taken";
            return $this->render('myaccount/register.html.twig', ['error' => $error]);
        }
        if(!UserValidation::isValidEmail($userRepository, $_POST['email'])) {
            $error = "Invalid email or email already taken";
            return $this->render('myaccount/register.html.twig', ['error' => $error]);
        }
        if(!UserValidation::isValidUser($userRepository, $_POST)) {
            $error = "Invalid data entered";
            return $this->render('myaccount/register.html.twig', ['error' => $error]);
        }


        $countryRepository = $entityManager->getRepository('App:Country');
        $country = $countryRepository->findOneBy(['name' => $_POST['country']]);
        if($country == null) {
            $qb = $countryRepository->createQueryBuilder('cou');
            $count = $qb->select('count(cou.countryId)')
                ->getQuery()->getSingleScalarResult();

            $country = new Country();
            $country->setCountryId($count + 1);
            $country->setName($_POST['country']);

            $entityManager->persist($country);
            $entityManager->flush();

            $country = $countryRepository->findOneBy(['name' => $_POST['country']]);
        }

        $cityRepository = $entityManager->getRepository('App:City');
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

            $city = $cityRepository->findOneBy(['name' => $_POST['city']]);
        }

        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setCity($city);
        $user->setAddress($_POST['address']);
        $user->setEmail($_POST['email']);
        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $user->setPassword($_POST['password']);
        $user->setPhone($_POST['phone']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirect("/login");
    }
}