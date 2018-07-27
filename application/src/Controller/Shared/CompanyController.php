<?php

namespace App\Controller\Shared;

use App\Entity\Shared\Company;
use App\Form\Shared\CompanyType;
use App\Repository\Shared\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/company")
 */
class CompanyController extends Controller
{
    /**
     * @Route("/", name="shared_company_index", methods="GET")
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('shared_company/index.html.twig', ['companies' => $companyRepository->findAll()]);
    }

    /**
     * @Route("/new", name="shared_company_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('shared_company_index');
        }

        return $this->render('shared_company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_show", methods="GET")
     */
    public function show(Company $company): Response
    {
        return $this->render('shared_company/show.html.twig', ['company' => $company]);
    }

    /**
     * @Route("/{id}/edit", name="shared_company_edit", methods="GET|POST")
     */
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_company_edit', ['id' => $company->getId()]);
        }

        return $this->render('shared_company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_delete", methods="DELETE")
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('shared_company_index');
    }
}
