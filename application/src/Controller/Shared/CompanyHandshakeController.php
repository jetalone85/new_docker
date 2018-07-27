<?php

namespace App\Controller\Shared;

use App\Entity\Shared\CompanyHandshake;
use App\Form\Shared\CompanyHandshakeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/company/handshake")
 */
class CompanyHandshakeController extends Controller
{
    /**
     * @Route("/", name="shared_company_handshake_index", methods="GET")
     */
    public function index(): Response
    {
        $companyHandshakes = $this->getDoctrine()
            ->getRepository(CompanyHandshake::class)
            ->findAll();

        return $this->render('shared_company_handshake/index.html.twig', ['company_handshakes' => $companyHandshakes]);
    }

    /**
     * @Route("/new", name="shared_company_handshake_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $companyHandshake = new CompanyHandshake();
        $form = $this->createForm(CompanyHandshakeType::class, $companyHandshake);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($companyHandshake);
            $em->flush();

            return $this->redirectToRoute('shared_company_handshake_index');
        }

        return $this->render('shared_company_handshake/new.html.twig', [
            'company_handshake' => $companyHandshake,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_handshake_show", methods="GET")
     */
    public function show(CompanyHandshake $companyHandshake): Response
    {
        return $this->render('shared_company_handshake/show.html.twig', ['company_handshake' => $companyHandshake]);
    }

    /**
     * @Route("/{id}/edit", name="shared_company_handshake_edit", methods="GET|POST")
     */
    public function edit(Request $request, CompanyHandshake $companyHandshake): Response
    {
        $form = $this->createForm(CompanyHandshakeType::class, $companyHandshake);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_company_handshake_edit', ['id' => $companyHandshake->getId()]);
        }

        return $this->render('shared_company_handshake/edit.html.twig', [
            'company_handshake' => $companyHandshake,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_handshake_delete", methods="DELETE")
     */
    public function delete(Request $request, CompanyHandshake $companyHandshake): Response
    {
        if ($this->isCsrfTokenValid('delete'.$companyHandshake->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyHandshake);
            $em->flush();
        }

        return $this->redirectToRoute('shared_company_handshake_index');
    }
}
