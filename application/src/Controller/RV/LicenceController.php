<?php

namespace App\Controller\RV;

use App\Entity\RV\Licence;
use App\Form\RV\LicenceType;
use App\Repository\RV\LicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/r/v/licence")
 */
class LicenceController extends Controller
{
    /**
     * @Route("/", name="r_v_licence_index", methods="GET")
     */
    public function index(LicenceRepository $licenceRepository): Response
    {
        return $this->render('r_v_licence/index.html.twig', ['licences' => $licenceRepository->findAll()]);
    }

    /**
     * @Route("/new", name="r_v_licence_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $licence = new Licence();
        $form = $this->createForm(LicenceType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($licence);
            $em->flush();

            return $this->redirectToRoute('r_v_licence_index');
        }

        return $this->render('r_v_licence/new.html.twig', [
            'licence' => $licence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_v_licence_show", methods="GET")
     */
    public function show(Licence $licence): Response
    {
        return $this->render('r_v_licence/show.html.twig', ['licence' => $licence]);
    }

    /**
     * @Route("/{id}/edit", name="r_v_licence_edit", methods="GET|POST")
     */
    public function edit(Request $request, Licence $licence): Response
    {
        $form = $this->createForm(LicenceType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('r_v_licence_edit', ['id' => $licence->getId()]);
        }

        return $this->render('r_v_licence/edit.html.twig', [
            'licence' => $licence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="r_v_licence_delete", methods="DELETE")
     */
    public function delete(Request $request, Licence $licence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$licence->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($licence);
            $em->flush();
        }

        return $this->redirectToRoute('r_v_licence_index');
    }
}
