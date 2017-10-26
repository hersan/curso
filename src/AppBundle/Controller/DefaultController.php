<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/buscar/{id}", name="homepage")
     */
    public function buscarAction(Request $request, $id)
    {
        $persona =$this->getDoctrine()
                    ->getRepository('AppBundle:Persona')
                    ->find($id);

        return $this->render('default/index.html.twig', [
            'persona' => $persona,
        ]);
    }

    /**
     * @Route("/nombre", name="mi_nombre")
     * @Method({"POST"})
     * @Template("default/nombre.html.twig")
     */
    public function nombreAction(Request $request)
    {
        $form = $this->createFormBuilder(new Persona())
            ->setAction($this->generateUrl('mi_nombre'))
            ->add('nombre', TextType::class, ['label' => 'Nombre:', 'attr' => ['class' => 'form-control']])
            ->add('apellido', TextType::class, ['label' => 'Apellido:','attr' => ['class' => 'form-control']])
            ->add('edad', TextType::class,  ['label' => 'Edad:','attr' => ['class' => 'form-control']])
            ->add('guardar', SubmitType::class, ['label' => 'salvar', 'attr' => ['class' => 'btn btn-default']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $persona = $form->getData();

            $em->persist($persona);
            $em->flush();
        }

        return [
            'persona' => $persona,
        ];
    }

    /**
     * @Route("/show", name="formulario")
     * @Method({"GET"})
     * @Template("default/formulario.html.twig")
     */
    public function showAction(Request $request)
    {
        $form = $this->createFormBuilder(new Persona())
            ->setAction($this->generateUrl('mi_nombre'))
            ->add('nombre', TextType::class, ['label' => 'Nombre:', 'attr' => ['class' => 'form-control']])
            ->add('apellido', TextType::class, ['label' => 'Apellido:','attr' => ['class' => 'form-control']])
            ->add('edad', TextType::class,  ['label' => 'Edad:','attr' => ['class' => 'form-control']])
            ->add('guardar', SubmitType::class, ['label' => 'salvar', 'attr' => ['class' => 'btn btn-default']])
            ->getForm();
        ;

        return $this->render('default/formulario.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}