<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
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
            $courses->upload();
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

        $courseAttachmentsOriginals = $coursesManager->courseAttachmentsOriginals($course);

        if($coursesForm->isValid()){

            //$course->upload();

            $course->getCoursesCovers()->setCourses($course);
            $course->getCoursesCovers()->upload();

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

        $courseAttachmentsForm = $this->createForm('moocsy_course_attachments_type', $course)->handleRequest($request);

        if($courseAttachmentsForm->isValid()){

            foreach($course->getAttachments() as $attachment){
                $attachment->upload();
                $attachment->setCourses($course);
            }

            $coursesManager->updateCourseAttachment($course, $courseAttachmentsOriginals);
            $this->get('artesanus.flashers')->add('info','Se han actualizado los datos de los usuarios del Curso');
            return $this->redirect($this->generateUrl('moocsy_admin_course', array('course' => $course->getSlug())));
        }

        return $this->render('MoocsyBundle:Courses:course.html.twig', array(
            'course'                    => $course,
            'courses_form'              => $coursesForm->createView(),
            'course_user_form'          => $courseUserForm->createView(),
            'course_attachment_form'    => $courseAttachmentsForm->createView()
        ));
    }

    public function frontAction($course)
    {
        $courseManager = $this->get('moocsy.courses_manager');

        $course = $courseManager->findOneBySlug($course);

        $courseUser = $courseManager->findCourseUser($course, $this->getUser());
        
        if(null === $courseUser){
            $this->get('artesanus.flashers')->add('warning','El curso al que estás tratando de acceder no existe');
            return $this->redirect($this->generateUrl('artesanus_front_user_profile'));
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

    public function coursesProfileAction()
    {
        if(!$this->isGranted("IS_AUTHENTICATED_FULLY")){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $coursesManager = $this->get('moocsy.courses_manager');
        $courses = $coursesManager->findCoursesUser();

        return $this->render('MoocsyBundle:Profile:courses.html.twig', array(
            'courses' => $courses
        ));
    }

    public function userAction($course, $user)
    {

        $coursesManager = $this->get('moocsy.courses_manager');
        $course = $coursesManager->findOneBySlug($course);

        return $this->render('MoocsyBundle:Courses:user.html.twig', array(
            'course'                    => $course,
        ));
    }

    public function copyAction($course)
    {
        /**
         * Create Course
         */
        $coursesManager = $this->get('moocsy.courses_manager');
        $course = $coursesManager->findOneBySlug($course);

        $newCourse = $coursesManager->create();

        $quantityCourses = count($coursesManager->findAll()) + 1;

        $newCourse->setCourse($course->getCourse()."-".$quantityCourses);
        $newCourse->setDescription($course->getDescription());
        $newCourse->setTemporality($course->getTemporality());
        $newCourse->setEnabled($course->getEnabled());
        $newCourse->setPublished($course->getPublished());
        $newCourse->setSKU($course->getSKU());
        $newCourse->setPath($course->getPath());

        /**
         * Persist Course
         */

        $coursesManager->save($newCourse);

        /**
         * Create CourseCovers
         */

        $coursesCoversManager = $this->get('moocsy.courses_covers_manager');
        $coursesCovers = $coursesCoversManager->create();

        $coursesCovers->setCourses($newCourse);

        if($course->getCoursesCovers()){
            $coursesCovers->setPath($course->getCoursesCovers()->getPath());
        }



        /**
         * Persist CourseCovers
         */

        $coursesCoversManager->save($coursesCovers);

        /**
         * Create Course Modules
         */

        foreach($course->getModules() as $module){

            $modulesManager = $this->get('moocsy.modules_manager');
            $modules = $modulesManager->create();

            $modules->setCourses($newCourse);
            $modules->setModule($module->getModule());
            $modules->setDescription($module->getDescription());

            $modulesManager->save($modules);

        }


        return $this->redirect($this->generateUrl('moocsy_admin_courses'));
    }
}
