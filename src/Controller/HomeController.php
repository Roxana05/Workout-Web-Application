<?php

namespace App\Controller;

use App\Repository\UserEventRepository;
use Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {
        $user = $this->getUser();
        $isAdmin = false;
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
             $isAdmin = true;
    }
        return $this->render('home/home.html.twig', [
            'isAdmin' => $isAdmin,
            'user' => $user,
            'title' => 'Welcome to Base Fit',
            'params' => ['menu_item' => ''],
        ]);
    }

    /**
     * @throws Exception
     */
    public function sidebar(array $params
    ): Response {

        $params = array_merge(['menu_item' => 'home'], $params);
        $date = date('Y-m-d H:i:s'); //today date
        $week = [];
        $date = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($date)));
        for($i =1; $i <= 7; $i++){
            $date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($date)));
            $item = [];
            $item['day'] = date('l', strtotime($date));
            $item['date'] = date('Y-m-d', strtotime($date));
            $week[$i] = $item;
        }

        return $this->render('home/_sideBar.html.twig', [
            'title' => 'Current week\'s schedule',
            'day' => null,
            'days' => $week,
            'params' => $params,
        ]);
    }

    #[Route(path: '/day/{date}/{day}', name: 'view_day')]
    public function viewDay(string $date, string $day,
    UserEventRepository $userEventRepository): Response
    {
        $user = $this->getUser();
        $events = $userEventRepository->getUserEventsForUserForDate($user, date('Y-m-d', strtotime($date)));
        return $this->render('home\_dailySchedule.html.twig', [
            'user' => $user,
            'day' => $date,
            'events' => $events,
            'text' => 'this is a daily schedule',
            'params' => ['menu_item' => $day],
        ]);
    }
}