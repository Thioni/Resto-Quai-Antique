<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController {

    #[Route("/user-booking", name: "user_booking")]
    public function createBooking(): Response {
        return $this->render('user/booking.html.twig');
    }


}