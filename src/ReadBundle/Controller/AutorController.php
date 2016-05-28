<?php

namespace ReadBundle\Controller;

use ReadBundle\Entity\Autor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AutorController extends Controller
{
    /**
     * @Route("autor")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Autor');

        return $this->render('@Read/Autor/index.html.twig', array('itens' => $repository->findAll()));
    }

    /**
     * @Route("/autorCadastrar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $autor = new Autor();

        $form = $this->createFormBuilder($autor)
            ->add('nome', TextType::class)
            ->add('Salvar', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dadosRequest = $request->request->get('form');

            $autor->setNome($dadosRequest['nome']);
            $autor->setAtivo(true);

            $this->getDoctrine()->getRepository('ReadBundle:Autor')->save($autor);

            return $this->redirectToRoute('read_autor_index');
        }

        return $this->render(
            '@Read/templates/cadastro.html.twig',
            array('form' => $form->createView(), 'sucesso' => true)
        );

    }

    /**
     * @Route("/acervosPorAutor/{id}")
     * @param $autor
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findAcervosByAutor($id)
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Acervo');

        return $this->render('@Read/Autor/acervos-autor.html.twig', array('acervos' => $repository->findBy(array('autor' => $id))));
    }

}
