<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoursesController extends Controller
{
    public function indexAction()
    {
        $coursesManager = $this->get('moocsy.courses_manager');

        $courses = $coursesManager->findAll();

        return $this->render('MoocsyBundle:Courses:courses.html.twig', array('courses' => $courses));
    }

    public function newAction(Request $request)
    {
        $coursesManager = $this->get('moocsy.courses_manager');
        $courses = $coursesManager->create();

        $coursesForm = $this->createForm('moocsy_courses_type', $courses)->handleRequest($request);

        if($coursesForm->isValid()){
            $coursesManager->save($courses);

            $this->get('artesanus.flashers')->add('info','Se ha creado un nuevo curso');

            return $this->redirect($this->generateUrl('moocsy_admin_course', array('course' => $courses->getSlug())));

        }

        return $this->render('MoocsyBundle:Courses:courses-new.html.twig', array(
            'courses_form' => $coursesForm->createView()
        ));
    }

    public function editAction($course, Request $request)
    {
        $coursesManager = $this->get('moocsy.courses_manager');
        $course = $coursesManager->findOneBySlug($course);

        $coursesForm = $this->createForm('moocsy_courses_type', $course)->handleRequest($request);

        $coursesUsersOriginales = $coursesManager->coursesUsersOriginales($course);

        if($coursesForm->isValid()){
            $coursesManager->update($course);
            $this->get('artesanus.flashers')->add('info','El Curso se ha modificado');
            return $this->redirect($this->generateUrl('moocsy_admin_course', array('course' => $course->getSlug())));
        }

        $courseUserForm = $this->createForm('moocsy_course_user_type', $course)->handleRequest($request);

        if($courseUserForm->isValid()){

            foreach($course->getCoursesUsers() as $opcion){
                $opcion->setCourses($course);
            }

            $coursesManager->updateCoursesUsers($course, $coursesUsersOriginales);
            $this->get('artesanus.flashers')->add('info','Se han actualizado los datos de los usuarios del Curso');
            return $this->redirect($this->generateUrl('moocsy_admin_course', array('course' => $course->getSlug())));
        }

        return $this->render('MoocsyBundle:Courses:course.html.twig', array(
            'course'           => $course,
            'courses_form'     => $coursesForm->createView(),
            'course_user_form' => $courseUserForm->createView()
        ));
    }

    public function frontAction($course)
    {
        $courseManager = $this->get('moocsy.courses_manager');

        $courseUser = $courseManager->findCourseUser($course);

        if(null === $courseUser){
            exit('El curso no existe');
        }

        $interval = $courseManager->interval($courseUser);

        $modulesReleased = array();

        if(is_int($interval)){
            $modulesReleased = $courseManager->modulesReleased($courseUser);
        }

        return $this->render('MoocsyBundle:Front:courses.html.twig', array(
            'course' => $courseUser,
            'modules_released' => $modulesReleased
        ));
    }

    public function deleteAction($course, Request $request)
    {
        $coursesManager = $this->get('moocsy.courses_manager');
        $course = $coursesManager->findOneBySlug($course);

        $coursesManager->delete($course);

        $this->get('artesanus.flashers')->add('warning','Se ha eliminado un curso');
        return $this->redirect($this->generateUrl('moocsy_admin_courses'));
    }
}
