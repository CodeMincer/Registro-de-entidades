<?php

namespace App\Controller;

use App\Entity\Compras;
use App\Form\Compras1Type;
use App\Repository\ComprasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compras')]
class ComprasController extends AbstractController
{
    #[Route('/', name: 'app_compras_index', methods: ['GET'])]
    public function index(ComprasRepository $comprasRepository): Response
    {
        return $this->render('compras/index.html.twig', [
            'compras' => $comprasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compras_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComprasRepository $comprasRepository): Response
    {
        $compra = new Compras();
        $form = $this->createForm(Compras1Type::class, $compra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comprasRepository->save($compra, true);

            return $this->redirectToRoute('app_compras_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compras/new.html.twig', [
            'compra' => $compra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compras_show', methods: ['GET'])]
    public function show(Compras $compra): Response
    {
        return $this->render('compras/show.html.twig', [
            'compra' => $compra,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compras_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compras $compra, ComprasRepository $comprasRepository): Response
    {
        $form = $this->createForm(Compras1Type::class, $compra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comprasRepository->save($compra, true);

            return $this->redirectToRoute('app_compras_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compras/edit.html.twig', [
            'compra' => $compra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compras_delete', methods: ['POST'])]
    public function delete(Request $request, Compras $compra, ComprasRepository $comprasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compra->getId(), $request->request->get('_token'))) {
            $comprasRepository->remove($compra, true);
        }

        return $this->redirectToRoute('app_compras_index', [], Response::HTTP_SEE_OTHER);
    }
}
