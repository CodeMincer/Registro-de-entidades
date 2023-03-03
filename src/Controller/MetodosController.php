<?php

namespace App\Controller;

use App\Entity\Metodos;
use App\Form\MetodosType;
use App\Repository\MetodosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/metodos')]
class MetodosController extends AbstractController
{
    #[Route('/', name: 'app_metodos_index', methods: ['GET'])]
    public function index(MetodosRepository $metodosRepository): Response
    {
        return $this->render('metodos/index.html.twig', [
            'metodos' => $metodosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_metodos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MetodosRepository $metodosRepository): Response
    {
        $metodo = new Metodos();
        $form = $this->createForm(MetodosType::class, $metodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metodosRepository->save($metodo, true);

            return $this->redirectToRoute('app_metodos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('metodos/new.html.twig', [
            'metodo' => $metodo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_metodos_show', methods: ['GET'])]
    public function show(Metodos $metodo): Response
    {
        return $this->render('metodos/show.html.twig', [
            'metodo' => $metodo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_metodos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Metodos $metodo, MetodosRepository $metodosRepository): Response
    {
        $form = $this->createForm(MetodosType::class, $metodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $metodosRepository->save($metodo, true);

            return $this->redirectToRoute('app_metodos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('metodos/edit.html.twig', [
            'metodo' => $metodo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_metodos_delete', methods: ['POST'])]
    public function delete(Request $request, Metodos $metodo, MetodosRepository $metodosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metodo->getId(), $request->request->get('_token'))) {
            $metodosRepository->remove($metodo, true);
        }

        return $this->redirectToRoute('app_metodos_index', [], Response::HTTP_SEE_OTHER);
    }
}
