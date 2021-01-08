<?php
namespace App\Controller;
use App\Repository\AuthorRepository;
use App\Repository\GenreRepository;
use App\Repository\LanguageRepository;
use App\Repository\PublisherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Entity\BookAuthor;

class ProductController extends AbstractController {
    /**
     * @return Response
     * @Route("/home/{isbn}", name="app_product")
     */
    public function details($isbn, AuthorRepository $authorRepository, GenreRepository $genreRepository,
            LanguageRepository $languagesRepository, PublisherRepository $publishersRepository): Response {
        # Get book
        $entityManager = $this->getDoctrine()->getManager();
        $book = $entityManager->getRepository('App:Book')->findOneBy(['isbn' => $isbn]);
        # Get authors
        $authors = $authorRepository->findAuthors($isbn);
        # Get genres
        $genres = $genreRepository->findGenres($isbn);
        # Get language
        $language = $languagesRepository->findLanguage($isbn);
        # Get publisher
        $publisher = $publishersRepository->findPublisher($isbn);
        return $this->render('product/product.html.twig', [
            'book' => $book,
            'authors' => $authors,
            'genres' => $genres,
            'language' => $language,
            'publisher' => $publisher,
            'isbn' => $isbn
        ]);
    }

}