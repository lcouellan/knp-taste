<?php


namespace App\Controller;


use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * Homepage of the application
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction()
    {
        return $this->render('home/homepage.html.twig');
    }

    /**
     * Page About us
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutusAction()
    {
        return $this->render('home/aboutus.html.twig');
    }

    /**
     * Contact Page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        return $this->render('home/contact.html.twig');
    }


    /**
     * Pricing Page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pricingAction()
    {
        return $this->render('home/pricing.html.twig');
    }


}