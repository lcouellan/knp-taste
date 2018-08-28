<?php


namespace App\Controller;


use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    public function homepageAction()
    {
        return $this->render('course/homepage.html.twig');
    }

    public function viewAllCourses()
    {

        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->render('course/show_all.html.twig', [
            'courses' => $courses
        ]);
    }

    public function viewCourse($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        if(!$course instanceof Course) {
            $session = $this->container->get('session');
            $session->getFlashBag()->add('error', 'This course doesn\'t exist');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('course/show.html.twig', [
            'course' => $course
        ]);
    }
}