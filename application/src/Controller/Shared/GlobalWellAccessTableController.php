<?php

namespace App\Controller\Shared;

use App\Entity\Shared\GlobalWellAccessTable;
use App\Form\Shared\GlobalWellAccessTableType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/global/well/access/table")
 */
class GlobalWellAccessTableController extends Controller
{
    /**
     * @Route("/", name="shared_global_well_access_table_index", methods="GET")
     */
    public function index(): Response
    {
        $globalWellAccessTables = $this->getDoctrine()
            ->getRepository(GlobalWellAccessTable::class)
            ->findAll();

        return $this->render('shared_global_well_access_table/index.html.twig', ['global_well_access_tables' => $globalWellAccessTables]);
    }

    /**
     * @Route("/new", name="shared_global_well_access_table_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $globalWellAccessTable = new GlobalWellAccessTable();
        $form = $this->createForm(GlobalWellAccessTableType::class, $globalWellAccessTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($globalWellAccessTable);
            $em->flush();

            return $this->redirectToRoute('shared_global_well_access_table_index');
        }

        return $this->render('shared_global_well_access_table/new.html.twig', [
            'global_well_access_table' => $globalWellAccessTable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_global_well_access_table_show", methods="GET")
     */
    public function show(GlobalWellAccessTable $globalWellAccessTable): Response
    {
        return $this->render('shared_global_well_access_table/show.html.twig', ['global_well_access_table' => $globalWellAccessTable]);
    }

    /**
     * @Route("/{id}/edit", name="shared_global_well_access_table_edit", methods="GET|POST")
     */
    public function edit(Request $request, GlobalWellAccessTable $globalWellAccessTable): Response
    {
        $form = $this->createForm(GlobalWellAccessTableType::class, $globalWellAccessTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_global_well_access_table_edit', ['id' => $globalWellAccessTable->getId()]);
        }

        return $this->render('shared_global_well_access_table/edit.html.twig', [
            'global_well_access_table' => $globalWellAccessTable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_global_well_access_table_delete", methods="DELETE")
     */
    public function delete(Request $request, GlobalWellAccessTable $globalWellAccessTable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$globalWellAccessTable->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($globalWellAccessTable);
            $em->flush();
        }

        return $this->redirectToRoute('shared_global_well_access_table_index');
    }
}
