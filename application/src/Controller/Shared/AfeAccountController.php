<?php

namespace App\Controller\Shared;

use App\Entity\Shared\AfeAccount;
use App\Form\Shared\AfeAccountType;
use App\Repository\Shared\AfeAccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shared/afe/account")
 */
class AfeAccountController extends Controller
{
    /**
     * @Route("/", name="shared_afe_account_index", methods="GET")
     */
    public function index(AfeAccountRepository $afeAccountRepository): Response
    {
        return $this->render('shared_afe_account/index.html.twig', ['afe_accounts' => $afeAccountRepository->findAll()]);
    }

    /**
     * @Route("/new", name="shared_afe_account_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $afeAccount = new AfeAccount();
        $form = $this->createForm(AfeAccountType::class, $afeAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($afeAccount);
            $em->flush();

            return $this->redirectToRoute('shared_afe_account_index');
        }

        return $this->render('shared_afe_account/new.html.twig', [
            'afe_account' => $afeAccount,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_afe_account_show", methods="GET")
     */
    public function show(AfeAccount $afeAccount): Response
    {
        return $this->render('shared_afe_account/show.html.twig', ['afe_account' => $afeAccount]);
    }

    /**
     * @Route("/{id}/edit", name="shared_afe_account_edit", methods="GET|POST")
     */
    public function edit(Request $request, AfeAccount $afeAccount): Response
    {
        $form = $this->createForm(AfeAccountType::class, $afeAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shared_afe_account_edit', ['id' => $afeAccount->getId()]);
        }

        return $this->render('shared_afe_account/edit.html.twig', [
            'afe_account' => $afeAccount,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shared_afe_account_delete", methods="DELETE")
     */
    public function delete(Request $request, AfeAccount $afeAccount): Response
    {
        if ($this->isCsrfTokenValid('delete'.$afeAccount->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($afeAccount);
            $em->flush();
        }

        return $this->redirectToRoute('shared_afe_account_index');
    }
}
