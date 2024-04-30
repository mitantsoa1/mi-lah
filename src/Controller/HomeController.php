<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Controller\BaseController;
use App\Entity\Queued;
use App\Repository\OperationRepository;
use App\Repository\QueuedRepository;
use App\Service\HomeService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    #[Route('/home', name: 'home')]
    public function index(QueuedRepository $repository, OperationRepository $repo): Response
    {
        $queued = $repository->getQueuedWithOperation();
        $operations = $repo->findAll();

        return $this->render('home/home.html.twig', [
            'queued' => $queued,
            'operations' => $operations
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
        $type = $request->request->get('ticket');
        $numero = $homeService->setNumeroticket();

        $nbr = strlen($numero);

        switch ($nbr) {
            case 1:
                # code...
                $numero = "00" . $numero;
                break;
            case 2:
                # code...
                $numero = "0" . $numero;
                break;

            default:
                # code...
                $numero = substr($numero, 0, 3);
                break;
        }

        $queued = new Queued;

        $queued->setType($type);
        $queued->setPosition($value);
        $queued->setNumero($numero);
        $queued->setStatus('A');
        $queued->setCreatedAt(new \DateTimeImmutable());

        $this->save($queued);

        $numeroTicket = substr($type, 0, 1) . $queued->getNumero();

        return new Response($numeroTicket);
    }

    #[Route('/editQueue', name: 'editQueue')]
    public function editQueue(Request $request, QueuedRepository $repo)
    {
        $id = $request->request->get('id');
        $ticket = $request->request->get('ticket');
        $status = $request->request->get('stat');
        $queued = $repo->find($id);
        $user = $this->getUser();
        $login = $user->getLogin();

        switch ($status) {
            case 'A':
                # code...
                $prochainStatus = "E";
                break;
            case 'E':
                # code...
                $prochainStatus = "T";
                // $updatedAt = new \DateTimeImmutable();
                break;
            case 'T':
                # code...
                $prochainStatus = "T";
                break;

            default:
                # code...
                $prochainStatus = "T";
                break;
        }

        if ($user && $queued) {
            $queued->setUser($login);
            $queued->setUpdatedAt(new \DateTimeImmutable());
            $queued->setStatus($prochainStatus);

            $this->save($queued);
            return new Response(true);
        }
        return new Response(false);
    }
}
