<?php


namespace App\Controller;


use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{

    /**
     * Homepage of the application
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction()
    {
        return $this->render('course/homepage.html.twig');
    }

    /**
     * Page for choose which course to watch
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAllCourses()
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->render('course/show_all.html.twig', [
            'courses' => $courses
        ]);
    }

    /**
     * Page for watch the course
     *
     * @param $id : id of the course
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewCourse($id)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($id);

        // If the course is not find, redirect the user to the homepage
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