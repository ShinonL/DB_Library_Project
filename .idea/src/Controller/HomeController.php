<?php
namespace App\Controller;
use App\Entity\Book;
use App\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @return Response
     * @Route("/home", name="app_home")
     */
    public function home(): Response {
        $entityManager = $this->getDoctrine()->getManager();
        $entities = $entityManager->getRepository('App:Book')->findAll();
        $count1 = $count2 = $count3 = $count4 = 0;
        for($index = 0; $index < count($entities); $index++) {
            if($index % 4 === 0) {
                $books1[$count1] = $entities[$index];
                $count1++;
            } elseif ($index % 4 === 1) {
                $books2[$count2] = $entities[$index];
                $count2++;
            } elseif ($index % 4 === 2) {
                $books3[$count3] = $entities[$index];
                $count3++;
            } else {
                $books4[$count4] = $entities[$index];
                $count4++;
            }
        }
        $count = max($count1, $count2, $count3, $count4);
        return $this->render('home/home.html.twig', [
            'books1' => $books1,
            'books2' => $books2,
            'books3' => $books3,
            'books4' => $books4,
            'count' => $count,
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'count4' => $count4,
        ]);
    }
}