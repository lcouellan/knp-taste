<?php


namespace App\Controller;


use App\Entity\Course;
use App\Entity\User;
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
        $form = $this->createFormBuilder()
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match',
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat password']
            ])
            ->add('validate', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        $formView = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPlainPassword($data['password']);


            // Validate the user
            $validator = Validation::createValidator();
            $errors = $validator->validate($user);

            $userSameEmail = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['email' => $data['email']])
            ;
            $userSameUsername = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['username' => $data['username']])
            ;

            // User is not validated, error displayed
            if (count($errors) > 0 || $userSameEmail instanceof User || $userSameUsername instanceof User) {

                $errorsString = (string) $errors;

                return $this->render('user/signup.html.twig', [
                    'form' => $formView,
                    'errors' => $errorsString
                ]);
            }

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            //TODO: Connect the user

            // Redirect the user to the homepage
            $session = $this->container->get('session');
            $session->getFlashBag()->add('success', 'You are now connected');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $formView
        ]);
    }
}