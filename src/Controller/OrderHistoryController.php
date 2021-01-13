<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderHistoryController extends AbstractController {
    /**
     * @Route("/orderHistory", name="app_order_history")
     */
    public function orderHistory(Request $request) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $user = $request->getSession()->get('user');

        $entityManager = $this->getDoctrine()->getManager();
        $orderRepository = $entityManager->getRepository('App:Orders');
        $bookRepository = $entityManager->getRepository('App:Book');

        $qb = $orderRepository->createQueryBuilder('o');
        $orders = $qb->select()->where('o.username = ?1')->setParameter(1, $user->getUsername())
                        ->getQuery()->getResult();

        //return $this->render("test.html.twig", ['test' => $orders[0]->id]);


        $error = null;
        $frontBooks = null;
        foreach ($orders as $order) {
            $qbBooks = $bookRepository->createQueryBuilder('b');
            $books = $qbBooks->select('b.isbn', 'b.coverImage', 'b.price', 'b.title', 'bo.quantity as quantity')
                ->innerJoin('App:BookOrder', 'bo', Join::WITH, 'bo.isbn = b.isbn')
                ->innerJoin('App:Orders', 'o', Join::WITH, 'o.id = bo.order')
                ->where('o.id = ?1')->setParameter(1, $order->getId())
                ->getQuery()->getResult();

            $count = ($books == null) ? 0 : count($books);

            $subtotal = 0;
            foreach ($books as $book) {
                $subtotal += $book['price'] * $book['quantity'];
            }

            $frontBooks[] = [
                'orderId' => $order->getId(),
                'booksOrdered' => $books,
                'count' => $count,
                'total' => $subtotal + 15
            ];
        }

        if($frontBooks == null || count($frontBooks) == 0)
            $error = 'There is no order history!';

        return $this->render("myaccount/orderHistory.html.twig", [
            'books' => $frontBooks,
            'error' => $error
        ]);
    }
}