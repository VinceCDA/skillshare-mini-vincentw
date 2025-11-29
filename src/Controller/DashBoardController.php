<?php

namespace App\Controller;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashBoardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dash_board')]
    public function index(HttpClientInterface $client): Response
    {
        $uri = sprintf('https://api.openweathermap.org/data/2.5/weather?q=Paris&appid=%s&units=metric&lang=fr',  $this->getParameter('app.apikeyweather'));
        $response = $client->request('GET', $uri);
        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
            'weather' => json_decode($response->getContent()),
        ]);
    }
}
