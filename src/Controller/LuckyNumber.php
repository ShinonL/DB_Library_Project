<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyNumber {
    /**
     * @Route("/number", name="app_lucky_number")
     * @throws \Exception
     */
    public function number() : Response {
        $num = random_int(1, 10);
        return new Response('<html><body>Lucky number: '.$num.'</body></html>');
    }
}