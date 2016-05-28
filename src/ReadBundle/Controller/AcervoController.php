<?php

namespace ReadBundle\Controller;

use ReadBundle\Entity\Acervo;
use ReadBundle\Entity\Secao;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AcervoController
 * @package ReadBundle\Controller
 */
class AcervoController extends Controller
{
    /**
     * @Route("/acervo")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Acervo');

        return $this->render('ReadBundle:templates:acervo.html.twig', array('acervos' => $repository->findAll()));
    }

    /**
     * @Route("/")
     */
    public function ultimosAdicionadosAction()
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Acervo');

        return $this->render('ReadBundle:templates:index.html.twig', array('acervos' => $repository->findAll()));
    }

    /**
     * @Route("/acervo/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findOne($id)
    {
        $repository = $this->getDoctrine()->getRepository('ReadBundle:Acervo');

        return $this->render('ReadBundle:templates:acervo-detalhes.html.twig', array('item' => $repository->find($id)));
    }

    /**
     * @Route("/novo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request)
    {
        $acervo = new Acervo();

        $secoes = $this->getDoctrine()->getRepository('ReadBundle:Secao');

        $closures = function() use($secoes) {
            foreach($secoes->findAll() as $key => $secao){
                # yield [$secao->getNome()];
            }
        };

        $form = $this->createFormBuilder($acervo)
            ->add('titulo', TextType::class)
            ->add('descricao', TextareaType::class)
            ->add('autor', TextType::class)
            ->add('url', TextType::class)
            ->add('secao', ChoiceType::class, array('choices' => $closures))
            ->add('Salvar', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dadosRequest = $request->request->get('form');

            $acervo->setTitulo($dadosRequest['titulo']);
            $acervo->setDescricao($dadosRequest['descricao']);
            $acervo->setAutor($dadosRequest['autor']);
            $acervo->setDataCadastro(new \DateTime('now'));
            $acervo->setUrl($dadosRequest['url']);

            $this->getDoctrine()->getRepository('ReadBundle:Acervo')->save($acervo);

            return $this->redirectToRoute('read_acervo_index');
        }

        return $this->render(
            '@Read/templates/cadastro.html.twig',
            array('form' => $form->createView(), 'sucesso' => true)
        );

    }
}
