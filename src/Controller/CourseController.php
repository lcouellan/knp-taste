<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    /**
     * @Route("/", name="homepage");
     */
    public function homepageAction()
    {
        return $this->render('course/homepage.html.twig');
    }
}