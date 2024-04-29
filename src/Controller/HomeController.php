<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Controller\BaseController;
use App\Entity\Queued;
use App\Service\HomeService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/reception', name: 'reception')]
    public function reception(): Response
    {

        $operations = $this->getRepository(Operation::class)->findBy([], ['fonction' => 'ASC']);
        return $this->render('home/reception.html.twig', [
            'operations' => $operations,
        ]);
    }

    #[Route('/addQueue', name: 'addQueue')]
    public function addQueue(Request $request, HomeService $homeService)
    {
        $value = $request->request->get('value');

        $numero = $homeService->setNumeroticket();

        $queued = new Queued;

        $queued->setType($value);
        $queued->setNumero($numero);
        $queued->setStatus('A');
        $queued->setCreatedAt(new \DateTimeImmutable());

        $this->save($queued);

        $numeroTicket = $queued->getStatus() . $queued->getNumero();

        return new Response($numeroTicket);
    }
}
