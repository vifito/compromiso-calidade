<?php

namespace EnquisaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EnquisaBundle\Entity\Enquisa;
use EnquisaBundle\Form\EnquisaType;

/**
 * Enquisa controller.
 *
 * @Route("/admin/enquisa")
 */
class EnquisaController extends Controller
{
    /**
     * Lists all Enquisa entities.
     *
     * @Route("/", name="enquisa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $enquisas = $em->getRepository('EnquisaBundle:Enquisa')->findAll();

        return $this->render('enquisa/index.html.twig', array(
            'enquisas' => $enquisas,
        ));
    }

    /**
     * Dashboard.
     *
     * @Route("/dashboard", name="enquisa_dashboard")
     * @Method("GET")
     */
    public function dashboardAction()
    {                
        /** @var $em Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();
        $total = $em->getRepository('EnquisaBundle:Enquisa')->getTotal();
        
        $preguntaStats = $em->getRepository('EnquisaBundle:Enquisa')->getPreguntasStats();
        dump($preguntaStats);
        
        /*$preguntasStats = $em->getRepository('EnquisaBundle:Enquisa')->getPreguntasStats();
        dump($preguntasStats);*/

        return $this->render('enquisa/dashboard.html.twig', array(
            'total' => $total,
            'preguntas' => $preguntaStats,
            //'preguntasStats' => $preguntasStats,
        ));
    }
    
    /**
     *
     * @Route("/panel/{qid}", name="enquisa_panel")
     * @Method("GET")
     */
    public function questionAction(Request $request)
    {
        /** @var $em Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();
        $total = $em->getRepository('EnquisaBundle:Enquisa')->getTotal();
        
        $questionId = $request->query->get('qid');
        
        $preguntaStats = $em->getRepository('EnquisaBundle:Enquisa')->getPreguntaStats($questionId);
        
        /*$preguntasStats = $em->getRepository('EnquisaBundle:Enquisa')->getPreguntasStats();
        dump($preguntasStats);*/
        
        return new JsonResponse([
            'stats' => $preguntaStats,
        ]);
    }

    /**
     * Creates a new Enquisa entity.
     *
     * @Route("/new", name="enquisa_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $enquisa = new Enquisa();
        $form = $this->createForm('EnquisaBundle\Form\EnquisaType', $enquisa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enquisa);
            $em->flush();

            return $this->redirectToRoute('enquisa_show', array('id' => $enquisa->getId()));
        }

        return $this->render('enquisa/new.html.twig', array(
            'enquisa' => $enquisa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Enquisa entity.
     *
     * @Route("/{id}", name="enquisa_show", requirements = { "id" = "\d+" })
     * @Method("GET")
     */
    public function showAction(Enquisa $enquisa)
    {
        $deleteForm = $this->createDeleteForm($enquisa);

        return $this->render('enquisa/show.html.twig', array(
            'enquisa' => $enquisa,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Enquisa entity.
     *
     * @Route("/{id}/edit", name="enquisa_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Enquisa $enquisa)
    {
        $deleteForm = $this->createDeleteForm($enquisa);
        $editForm = $this->createForm('EnquisaBundle\Form\EnquisaType', $enquisa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enquisa);
            $em->flush();

            return $this->redirectToRoute('enquisa_edit', array('id' => $enquisa->getId()));
        }

        return $this->render('enquisa/edit.html.twig', array(
            'enquisa' => $enquisa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to upload an group of Enquisa entities.
     *
     * @Route("/upload", name="enquisa_upload")
     * @Method({"GET", "POST"})
     */
    public function uploadAction(Request $request)
    {
        $form = $this->createForm('EnquisaBundle\Form\UploadType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            ignore_user_abort(true);
            set_time_limit(0);

            //dump($scanner);
            $dir = $this->container->getParameter('kernel.root_dir') .
                '/../web/uploads/enquisas';

            $ficheiro = $form->getData()['ficheiro'];
            $filename = $dir . '/' . $ficheiro->getClientOriginalName();
            $ficheiro->move($dir, $ficheiro->getClientOriginalName());

            $restaurante = $form->getData()['restaurante'];

            /*$em = $this->getDoctrine()->getManager();
            $restaurante = $em->getRepository('EnquisaBundle:Restaurante')->find($restauranteId);*/

            /** @var $scanner \EnquisaBundle\Service\Scanner */
            $scanner = $this->container->get('scanner');
            $scanner->run($restaurante, $filename);

            return $this->redirectToRoute('enquisa_index');
        }

        return $this->render('enquisa/upload.html.twig', array(
            'upload_form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Enquisa entity.
     *
     * @Route("/{id}", name="enquisa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Enquisa $enquisa)
    {
        $form = $this->createDeleteForm($enquisa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($enquisa);
            $em->flush();
        }

        return $this->redirectToRoute('enquisa_index');
    }

    /**
     * Creates a form to delete a Enquisa entity.
     *
     * @param Enquisa $enquisa The Enquisa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Enquisa $enquisa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enquisa_delete', array('id' => $enquisa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
