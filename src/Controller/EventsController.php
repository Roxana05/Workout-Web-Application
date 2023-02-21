<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Entity\UserEvent;
use App\Form\CreateNewUserEventForm;
use App\Form\RegisterNewEvent;
use App\Repository\EventRepository;
use App\Repository\UserEventRepository;
use Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\Translation\TranslatorInterface;

class EventsController extends AbstractController
{
    #[Route(path: '/event/checkbox', name: 'change_event_status')]
    public function changeEventCompletionStatus(Request $request,
                          UserEventRepository $userEventRepository,
                          ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();

        dump($request->get('user_event'));
        $userEvent = $userEventRepository->findOneBy(['id' => $request->get('user_event')]);
        $option = $request->get('option');
        $userEvent->setCompleted($option);
        $entityManager->flush();
        dump($userEvent);
        return new Response(null);
    }

    #[route(path: '/create/new/event/{day}', name: 'create_new_event')]
    public function createNewEvent(
        Request $request,
        ManagerRegistry $managerRegistry,
        string $day,
    ): Response {

        $user = $this->getUser();

        $form = $this->createForm(CreateNewUserEventForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $managerRegistry->getManager();
            $entityManager->flush();
        }

        $date = $day != "false" ? $day: 'today';
        return $this->render('events/_create_new_event.html.twig', [
            'form' => $form->createView(),
            'day' => $day,
            'user' => $user,
            'title' => 'Create new exercise event for date: '.$date.'.',
        ]);
    }

    #[route(path: '/create/new/event/{day}/submit', name: 'create_new_event_submit')]
    public function createNewEventSubmit(
        Request $request,
        ManagerRegistry $managerRegistry,
        EventRepository $eventRepository,
        UserEventRepository $userEventRepository,
        string $day,
    ): Response {

        $user = $this->getUser();
        $userEvent = new UserEvent();
        $userEventData = (array) $request->get('data');
        parse_str($userEventData[0], $data);

        $event = $eventRepository->findOneBy(['id' => $data['create_new_user_event_form']['event']]);
        $userEvent->setEvent($event);
        $userEvent->setUser($user);
        $userEvent->setCreatedAt(new \DateTime());
        $date = $day ? new \DateTime($day): new \DateTime();
        $userEvent->setExerciseDate($date);
        $entityManager = $managerRegistry->getManager();
        $entityManager->persist($userEvent);
        $entityManager->flush();

        $events = $userEventRepository->getUserEventsForUserForDate($user, date('Y-m-d', strtotime($date)));
        return $this->render('home\_dailySchedule.html.twig', [
            'user' => $user,
            'day' => $date,
            'events' => $events,
            'text' => 'this is a daily schedule',
            'params' => ['menu_item' => $day],
        ]);

    }

    #[route(path: '/register/new/event', name: 'register_new_event')]
    public function registerNewEvent(
        Request $request,
        ManagerRegistry $managerRegistry,
    ): Response {

        $user = $this->getUser();

        $form = $this->createForm(RegisterNewEvent::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $managerRegistry->getManager();
            $entityManager->flush();
        }

        return $this->render('events/_register_new_event.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'title' => 'Register a new exercise ',
        ]);
    }

    #[route(path: '/register/new/event/submit', name: 'register_new_event_submit')]
    public function registerNewEventSubmit(
        Request $request,
        ManagerRegistry $managerRegistry,
        EventRepository $eventRepository,
        UserEventRepository $userEventRepository,
    ): Response {

        $user = $this->getUser();
        $event = new Event();
        $eventData = (array) $request->get('data');
        parse_str($eventData[0], $data);
        $data = $data['register_new_event'];

        $event->setCreatedAt(new \DateTime());
        $event->setTitle($data['title']);
        $event->setImageName($data['imageName']);
        $event->setExerciseType($data['exerciseType']);
        $event->setDescription($data['description']);
        $event->setExerciseSubType($data['exerciseSubType']);
        $entityManager = $managerRegistry->getManager();
        $entityManager->persist($event);
        $entityManager->flush();

        $isAdmin = false;
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            $isAdmin = true;
        }
        return $this->render('home/home.html.twig', [
            'isAdmin' => $isAdmin,
            'user' => $user,
            'day' => null,
            'title' => 'this is a daily schedule',
            'params' => ['menu_item' => ''],
        ]);

    }

    #[route(path: '/view∕archive', name: 'view_archive')]
    public function viewArchive(
        UserEventRepository $userEventRepository,
    ): Response {

        $user = $this->getUser();
        $events = $userEventRepository->getUserEventsForUser($user);
        return $this->render('events\_archive.html.twig', [
            'user' => $user,
            'events' => $events,
            'day' => null,
            'text' => 'this is a daily schedule',
            'params' => ['menu_item' => 'archive'],
        ]);
    }
}