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
          $availableSeats = $em->getRepository(Booking::class)->getAvailableSeats($timeslot);

          if ($freeSeats > $availableSeats) {
            $this->addFlash('error', 'Il ne reste plus assez de places disponibles sur ce créneau.');
            return $this->redirectToRoute('user_booking');
          }

          $em->persist($booking);
          $em->flush();
          $this->addFlash('success', 'Réservation validée.');
          return $this->redirectToRoute("dish_selection");
      }

      return $this->render('booking/create.html.twig', [
        "form" => $form
      ]);
  }

  #[Route("/booking-list", name: "booking_list")]
  public function getAll(ManagerRegistry $doctrine): Response {
    $repo = $doctrine->getRepository(Booking::class);
    $bookings = $repo->findAll();

    return $this->render('booking/list.html.twig', [
        "bookings" => $bookings,
    ]);
  }

  #[Route("admin/update-booking/{id}", name: "update_booking")]
  public function update(Request $request, ManagerRegistry $doctrine, Booking $booking): Response {

    $form = $this->createForm(BookingType::class, $booking);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $doctrine->getManager()->flush();
      $this->addFlash('success', sprintf('%s a été modifié.', $booking->getLastname()));
      return $this->redirectToRoute("booking_list");
    }

    return $this->render('booking/create.html.twig', [
      "form" => $form,
      "booking" => $booking
    ]);
  }

  #[Route("admin/delete-booking/{id}", name: "delete_booking")]
  public function delete(ManagerRegistry $doctrine, Booking $booking) : Response {

    $em = $doctrine->getManager();
    $em->remove($booking);
    $em->flush();

    $timeslot = $booking->getTimeslot();
    $timeslot = $timeslot->format('Y-m-d H:i:s');

    $this->addFlash(
      'success',
       sprintf(
          'La réservation pour %s %s du %s a été supprimée.',
          $booking->getLastname(),
          $booking->getFirstname(),
          $timeslot
      ));
    return $this->redirectToRoute("booking_list");
  }

}