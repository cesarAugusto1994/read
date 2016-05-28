<?php

namespace ReadBundle\Controller;

use ReadBundle\Entity\Secao;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SecaoController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Secao');

        return $this->render('ReadBundle:Secao:index.html.twig', array('itens' => $repository->findAll()));
    }

    /**
     * @Route("/secaoCadastrar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $secao = new Secao();

        $form = $this->createFormBuilder($secao)
            ->add('nome', TextType::class)
            ->add('Salvar', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dadosRequest = $request->request->get('form');

            $secao->setNome($dadosRequest['nome']);
            $secao->setStatus(true);

            $this->getDoctrine()->getRepository('ReadBundle:Secao')->save($secao);

            return $this->redirectToRoute('read_secao_index');
        }

        return $this->render(
            '@Read/templates/cadastro.html.twig',
            array('form' => $form->createView(), 'sucesso' => true)
        );

    }

}
