<?php


namespace App\Controller;


use App\Entity\Course;
use App\Entity\User;
use App\Form\Type\RegisterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

class UserController extends AbstractController
{

    /**
     * Page for new member subscription
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signupAction(Request $request)
    {
        $form = $this->createForm(RegisterFormType::class);

        $form->handleRequest($request);

        $formView = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var User $user */
            $user = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $user->setRoles(['ROLE_USER']);
            $manager->flush();

            // Redirect the user to the homepage
            $session = $this->container->get('session');
            $session->getFlashBag()->add('success', 'Your account has been successfully created');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $formView
        ]);
    }
}