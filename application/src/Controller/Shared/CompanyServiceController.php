<?php

namespace App\Controller\Shared;

use App\Entity\Shared\CompanyService;
use App\Form\Shared\CompanyServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/company/service")
 */
class CompanyServiceController extends Controller
{
    /**
     * @Route("/", name="shared_company_service_index", methods="GET")
     */
    public function index(): Response
    {
        $companyServices = $this->getDoctrine()
            ->getRepository(CompanyService::class)
            ->findAll();

        return $this->render('shared_company_service/index.html.twig', ['company_services' => $companyServices]);
    }

    /**
     * @Route("/new", name="shared_company_service_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $companyService = new CompanyService();
        $form = $this->createForm(CompanyServiceType::class, $companyService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($companyService);
            $em->flush();

            return $this->redirectToRoute('shared_company_service_index');
        }

        return $this->render('shared_company_service/new.html.twig', [
            'company_service' => $companyService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_service_show", methods="GET")
     */
    public function show(CompanyService $companyService): Response
    {
        return $this->render('shared_company_service/show.html.twig', ['company_service' => $companyService]);
    }

    /**
     * @Route("/{id}/edit", name="shared_company_service_edit", methods="GET|POST")
     */
    public function edit(Request $request, CompanyService $companyService): Response
    {
        $form = $this->createForm(CompanyServiceType::class, $companyService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_company_service_edit', ['id' => $companyService->getId()]);
        }

        return $this->render('shared_company_service/edit.html.twig', [
            'company_service' => $companyService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_company_service_delete", methods="DELETE")
     */
    public function delete(Request $request, CompanyService $companyService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$companyService->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($companyService);
            $em->flush();
        }

        return $this->redirectToRoute('shared_company_service_index');
    }
}
