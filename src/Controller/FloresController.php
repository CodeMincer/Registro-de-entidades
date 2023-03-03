<?php

namespace App\Controller;

use App\Entity\Flores;
use App\Form\FloresType;
use App\Repository\FloresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/flores')]
class FloresController extends AbstractController
{
    #[Route('/', name: 'app_flores_index', methods: ['GET'])]
    public function index(FloresRepository $floresRepository): Response
    {
        return $this->render('flores/index.html.twig', [
            'flores' => $floresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_flores_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FloresRepository $floresRepository): Response
    {
        $flore = new Flores();
        $form = $this->createForm(FloresType::class, $flore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $floresRepository->save($flore, true);

            return $this->redirectToRoute('app_flores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flores/new.html.twig', [
            'flore' => $flore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flores_show', methods: ['GET'])]
    public function show(Flores $flore): Response
    {
        return $this->render('flores/show.html.twig', [
            'flore' => $flore,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_flores_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Flores $flore, FloresRepository $floresRepository): Response
    {
        $form = $this->createForm(FloresType::class, $flore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $floresRepository->save($flore, true);

            return $this->redirectToRoute('app_flores_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flores/edit.html.twig', [
            'flore' => $flore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flores_delete', methods: ['POST'])]
    public function delete(Request $request, Flores $flore, FloresRepository $floresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flore->getId(), $request->request->get('_token'))) {
            $floresRepository->remove($flore, true);
        }

        return $this->redirectToRoute('app_flores_index', [], Response::HTTP_SEE_OTHER);
    }
}
