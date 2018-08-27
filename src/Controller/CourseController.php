<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    public function homepageAction()
    {
        return $this->render('course/homepage.html.twig');
    }
}