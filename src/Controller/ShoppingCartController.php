<?php

namespace App\Controller;

use App\Entity\BookOrder;
use App\Entity\Orders;
use App\Manager\BookDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController {
    /**
     * @Route("/shoppingCart", name="app_cart")
     */
    public function cart(Request $request) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $addedBooks = $request->getSession()->get('addedBooks');
        $subtotal = 0;
        if($addedBooks != null && count($addedBooks) != 0) {
            foreach ($addedBooks as $book) {
                $subtotal += $book->ammount * $book->price;
            }
            $cartStatus = "";
        } else {
            $cartStatus = $request->getSession()->get('cart');
            if($cartStatus == 'checkout') {
                $cartStatus = "Check out successfully!";
            }
            if($cartStatus == 'cleared') {
                $cartStatus = "Cart cleared successfully!";
            }
        }



        return $this->render("cart/cart.html.twig", [
            'subtotal' => $subtotal,
            'total' => $subtotal + 15,
            'books' => $addedBooks,
            'cart' => $cartStatus
        ]);

    }

    /**
     * @Route("/{isbn}/addToCart", name="app_add_cart")
     */
    public function addToCart(Request $request, $isbn) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $bookRepository = $this->getDoctrine()->getManager()->getRepository('App:Book');
        $book = $bookRepository->findOneBy(['isbn' => $isbn]);

        $addedBooks = $request->getSession()->get('addedBooks');

        $newBook = new BookDTO();
        $newBook->title = $book->getTitle();
        $newBook->price = $book->getPrice();
        $newBook->isbn = $book->getIsbn();
        $newBook->cover = $book->getCoverImage();
        $newBook->ammount = 1;

        if($addedBooks !== null) {
            foreach ($addedBooks as $book) {
                if ($book->isbn === $newBook->isbn) {
                    $book->ammount++;
                    $request->getSession()->set('addedBooks', $addedBooks);
                    return $this->redirect("/shoppingCart");
                }
            }
        }
        $addedBooks[] = $newBook;

        $request->getSession()->set('addedBooks', $addedBooks);

        return $this->redirect("/shoppingCart");
    }

    /**
     * @Route("/{isbn}/removeCart")
     */
    public function removeCart(Request $request, $isbn) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $addedBooks = $request->getSession()->get('addedBooks');

        for($index = 0; $index < count($addedBooks); $index++)
            if($addedBooks[$index]->isbn == $isbn) {
                unset($addedBooks[$index]);

                break;
            }

        $request->getSession()->set('addedBooks', $addedBooks);

        return $this->redirect("/shoppingCart");
    }

    /**
     * @Route("/{isbn}/minusBook")
     */
    public function minusBook(Request $request, $isbn) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $books = $request->getSession()->get('addedBooks');
        foreach ($books as $book) {
            if($book->isbn === $isbn) {
                if($book->ammount > 1) {
                    $book->ammount--;
                }
                break;
            }
        }
        $request->getSession()->set('addedBooks', $books);

        return $this->redirect("/shoppingCart");
    }

    /**
     * @Route("/{isbn}/plusBook")
     */
    public function plusBook(Request $request, $isbn) {
        if($request->getSession()->get('isLoggedIn') !== true) {
            return $this->redirect("/login");
        }

        $books = $request->getSession()->get('addedBooks');
        foreach ($books as $book) {
            if($book->isbn === $isbn) {
                $book->ammount++;
                break;
            }
        }
        $request->getSession()->set('addedBooks', $books);

        return $this->redirect("/shoppingCart");
    }

    /**
     * @Route("/checkout")
     */
    public function checkout(Request $request) {
        $books = $request->getSession()->get('addedBooks');
        if(count($books) > 0) {
            $request->getSession()->set('cart', 'checkout');
        }

        $user = $request->getSession()->get('user');
        $entityManager = $this->getDoctrine()->getManager();
        $shipRepository = $entityManager->getRepository('App:ShippingCompany');
        $orderRepository = $entityManager->getRepository('App:Orders');
        $bookOrderRepository = $entityManager->getRepository('App:BookOrder');
        $bookRepository = $entityManager->getRepository('App:Book');
        $qb = $orderRepository->createQueryBuilder('o');
        $countOrders = $qb->select('count(o.id)')->getQuery()->getSingleScalarResult();

        $order = new Orders();
        $order->setId($countOrders + 1);
        $order->setUsername($user->getUsername());
        $order->setOrderDate(date('Y-m-d'));
        $order->setShip($shipRepository->findOneBy(['shipId' => 1]));

        $entityManager->persist($order);
        $entityManager->flush();

        $order = $orderRepository->findOneBy(['id' => $countOrders+1]);

        $count = count($books);
        for($index = 0; $index < $count; $index++) {
            $qb = $bookOrderRepository->createQueryBuilder('bo');
            $countBookOrders = $qb->select('count(bo.id)')->getQuery()->getSingleScalarResult();

            $bookOrder = new BookOrder();
            $bookOrder->setId($countBookOrders + 1);
            $bookOrder->setIsbn($bookRepository->findOneBy(['isbn' => $books[$index]->isbn]));;
            $bookOrder->setOrder($order);
            $bookOrder->setQuantity($books[$index]->ammount);

            $entityManager->persist($bookOrder);
            $entityManager->flush();

            unset($books[$index]);
        }
        $request->getSession()->set('addedBooks', $books);
        return $this->redirect("/shoppingCart");
    }

    /**
     * @Route("/clearList")
     */
    public function clearList(Request $request) {
        $books = $request->getSession()->get('addedBooks');
        if(count($books) > 0) {
            $request->getSession()->set('cart', 'cleared');
        }
        $count = count($books);
        for($index = 0; $index < $count; $index++) {
            unset($books[$index]);
            //$books = array_values($books);
        }
        $request->getSession()->set('addedBooks', $books);
        return $this->redirect("/shoppingCart");
    }
}