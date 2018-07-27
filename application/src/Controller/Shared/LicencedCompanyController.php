<?php

namespace App\Controller\Shared;

use App\Entity\Shared\LicencedCompany;
use App\Form\Shared\LicencedCompanyType;
use App\Repository\Shared\LicencedCompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/licenced/company")
 */
class LicencedCompanyController extends Controller
{
    /**
     * @Route("/", name="shared_licenced_company_index", methods="GET")
     */
    public function index(LicencedCompanyRepository $licencedCompanyRepository): Response
    {
        return $this->render('shared_licenced_company/index.html.twig', ['licenced_companies' => $licencedCompanyRepository->findAll()]);
    }

    /**
     * @Route("/new", name="shared_licenced_company_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $licencedCompany = new LicencedCompany();
        $form = $this->createForm(LicencedCompanyType::class, $licencedCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($licencedCompany);
            $em->flush();

            return $this->redirectToRoute('shared_licenced_company_index');
        }

        return $this->render('shared_licenced_company/new.html.twig', [
            'licenced_company' => $licencedCompany,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_licenced_company_show", methods="GET")
     */
    public function show(LicencedCompany $licencedCompany): Response
    {
        return $this->render('shared_licenced_company/show.html.twig', ['licenced_company' => $licencedCompany]);
    }

    /**
     * @Route("/{id}/edit", name="shared_licenced_company_edit", methods="GET|POST")
     */
    public function edit(Request $request, LicencedCompany $licencedCompany): Response
    {
        $form = $this->createForm(LicencedCompanyType::class, $licencedCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_licenced_company_edit', ['id' => $licencedCompany->getId()]);
        }

        return $this->render('shared_licenced_company/edit.html.twig', [
            'licenced_company' => $licencedCompany,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_licenced_company_delete", methods="DELETE")
     */
    public function delete(Request $request, LicencedCompany $licencedCompany): Response
    {
        if ($this->isCsrfTokenValid('delete'.$licencedCompany->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($licencedCompany);
            $em->flush();
        }

        return $this->redirectToRoute('shared_licenced_company_index');
    }
}
