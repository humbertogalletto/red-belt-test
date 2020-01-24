<?php

namespace App\Controller;

use App\Entity\Contatos;
use App\Repository\ContatosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/contatos")
 */
class ContatosController extends ApiController
{
    /**
     * @Route("/", name="contatos_index", methods={"GET"})
     */
    public function index(ContatosRepository $contatosRepository): Response
    {
        $contatos = $contatosRepository->transformAll();

        return $this->respond($contatos);
    }

    /**
     * @Route("/new", name="contatos_new", methods={"GET","POST"})
     */
    public function new(Request $request, ContatosRepository $contatosRepository, EntityManagerInterface $entityManager)
    {
        $request = $this->transformJsonBody($request);
        if (!$request) {
            return $this->respondValidationError('Dados inexistentes!');
        }

        // validações
        if (!$request->get('Nome')) {
            return $this->respondValidationError('Por favor preencha o nome!');
        }
        if (!$request->get('Telefone')) {
            return $this->respondValidationError('Por favor preencha o telefone!');
        }

        // persist the new movie
        $contato = new Contatos;
        $contato->setNome($request->get('Nome'));
        $contato->setEmail($request->get('Email'));
        $contato->setTelefone($request->get('Telefone'));
        $entityManager->persist($contato);
        $entityManager->flush();

        return $this->respondCreated($contatosRepository->transform($contato));
    }

    /**
     * @Route("/{id}", name="contatos_show", methods={"GET"})
     */
    public function show(Contatos $contato, ContatosRepository $contatosRepository): Response
    {
        return $this->respond($contatosRepository->transform($contato));
    }

    /**
     * @Route("/{id}/edit", name="contatos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contatos $contato, ContatosRepository $contatosRepository, EntityManagerInterface $entityManager)
    {
        $request = $this->transformJsonBody($request);

        $contato->setNome($request->get('Nome'));
        $contato->setEmail($request->get('Email'));
        $contato->setTelefone($request->get('Telefone'));
        $entityManager->persist($contato);
        $entityManager->flush();

        return $this->respondUpdated($contatosRepository->transform($contato));
    }

    /**
     * @Route("/{id}", name="contatos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contatos $contato, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($contato);
        $entityManager->flush();

        return $this->respondDeleted([]);
    }
}
