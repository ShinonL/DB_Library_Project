<?php
namespace App\Controller;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {
    /**
     * @Route("/category/{genre}", name="app_category")
     */
    public function category($genre) {
        $bookRepository = $this->getDoctrine()->getRepository('App:Book');
        $qb = $bookRepository->createQueryBuilder('b');

        $qb->select()
            ->innerJoin('App\Entity\BookGenre', 'bg', Join::WITH, 'bg.isbn = b.isbn')
            ->innerJoin('App\Entity\Genre', 'g', Join::WITH, 'g.genreId = bg.genre')
            ->where('g.name = \''. $genre .'\'' );

        $books = $qb->getQuery()->getResult();

        $count1 = $count2 = $count3 = $count4 = 0;
        for($index = 0; $index < count($books); $index++) {
            if($index % 4 === 0) {
                $books1[$count1] = $books[$index];
                $count1++;
            } elseif ($index % 4 === 1) {
                $books2[$count2] = $books[$index];
                $count2++;
            } elseif ($index % 4 === 2) {
                $books3[$count3] = $books[$index];
                $count3++;
            } else {
                $books4[$count4] = $books[$index];
                $count4++;
            }
        }
        $count = max($count1, $count2, $count3, $count4);

        return $this->render('category/category.html.twig', [
            'books' => $books,
            'books1' => $books1,
            'books2' => $books2,
            'books3' => $books3,
            'books4' => $books4,
            'count' => $count,
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'count4' => $count4,
            'genre' => $genre
        ]);
    }
}