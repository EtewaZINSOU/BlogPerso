<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/blog", name="blog")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blogAction(Request $request)
    {
        return $this->render('default/blog.html.twig',[]);
    }

    /**
     * @Route("/watch", name="watch")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function watchAction(Request $request)
    {
        return $this->render('default/watch.html.twig',[]);
    }

    /**
     * @Route("/projects", name="projects")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function projectsAction(Request $request)
    {
        return $this->render('default/projects.html.twig',[]);
    }
}
