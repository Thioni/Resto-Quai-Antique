<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController {

    #[Route("/user-booking", name: "user_booking")]
    public function createBooking(Request $request, ManagerRegistry $doctrine): Response {
        $booking = new Booking();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $timeslot = $booking->getTimeslot();

            $day = $timeslot->format('N');
            $time = $timeslot->format('H:i:s');

            if ($day == 2 || $day == 4 || $time < '11:00:00' || ($time >= '13:00:00' 
                && $time < '18:00:00') || $time >= '22:00:00') {
                    $this->addFlash('error', 'Veuillez réserver pendant les horaires d\'ouverture.');
                    return $this->redirectToRoute('user_booking');
            }

            $em = $doctrine->getManager();
            $freeSeats = $booking->getSeats();

            //nombre de places dispos pour le moment fixe et arbitraire
            if ($freeSeats > 10) {
                $this->addFlash('error', 'Il ne reste plus assez de places disponibles.');
                return $this->redirectToRoute('user_booking');
            }

            // $em->persist($booking);
            // $em->flush();
            $this->addFlash('success', 'Réservation validée.');
            return $this->redirectToRoute("dish_selection");
        }

        return $this->render('booking/create.html.twig', [
            "form" => $form
        ]);
    }


}