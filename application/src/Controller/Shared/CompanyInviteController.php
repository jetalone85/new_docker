<?php

namespace App\Controller\Shared;

use App\Entity\Shared\CompanyInvite;
use App\Form\Shared\CompanyInviteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/company/invite")
 */
class CompanyInviteController extends Controller
{
    /**
     * @Route("/", name="shared_company_invite_index", methods="GET")
     */
    public function index(): Response
    {
        $companyInvites = $this->getDoctrine()
            ->getRepository(CompanyInvite::class)
            ->findAll();

        return $this->render('shared_company_invite/index.html.twig', ['company_invites' => $companyInvites]);
    }

    /**
     * @Route("/new", name="shared_company_invite_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $companyInvite = new CompanyInvite();
        $form = $this->createForm(CompanyInviteType::class, $companyInvite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($companyInvite);
            $em->flush();

            return $this->redirectToRoute('shared_company_invite_index');
        }

        return $this->render('shared_company_invite/new.html.twig', [
            'company_invite' => $companyInvite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_invite_show", methods="GET")
     */
    public function show(CompanyInvite $companyInvite): Response
    {
        return $this->render('shared_company_invite/show.html.twig', ['company_invite' => $companyInvite]);
    }

    /**
     * @Route("/{id}/edit", name="shared_company_invite_edit", methods="GET|POST")
     */
    public function edit(Request $request, CompanyInvite $companyInvite): Response
    {
        $form = $this->createForm(CompanyInviteType::class, $companyInvite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_company_invite_edit', ['id' => $companyInvite->getId()]);
        }

        return $this->render('shared_company_invite/edit.html.twig', [
            'company_invite' => $companyInvite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_invite_delete", methods="DELETE")
     */
    public function delete(Request $request, CompanyInvite $companyInvite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$companyInvite->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyInvite);
            $em->flush();
        }

        return $this->redirectToRoute('shared_company_invite_index');
    }
}
