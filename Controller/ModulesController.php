<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ArtesanIO\MoocsyBundle\Entity\Courses;
use ArtesanIO\MoocsyBundle\Entity\Modules;

class ModulesController extends Controller
{

    public function newAction($course, Request $request)
    {
        $coursesManager = $this->get('moocsy.courses_manager');
        $course = $coursesManager->findOneBySlug($course);

        $modulesManager = $this->get('moocsy.modules_manager');
        $modules = $modulesManager->create();

        $modulesForm = $this->createForm('moocsy_modules_type', $modules)->handleRequest($request);

        if($modulesForm->isValid()){

            $modules->setCourses($course);
            $module = $modulesManager->save($modules);

            return $this->redirect($this->generateUrl('moocsy_admin_course', array(
                'course' => $course->getSlug(),
            )));
        }

        return $this->render('MoocsyBundle:Modules:modules-new.html.twig', array(
            'course'       => $course,
            'module'       => $modules,
            'modules_form' => $modulesForm->createView()
        ));
    }

    public function editAction($course, $module, Request $request)
    {

        $module = $this->get('moocsy.modules_manager')->findOneModuleCourse($course, $module);

        $course = $module->getCourses();

        $modulesForm = $this->createForm('moocsy_modules_type', $module)->handleRequest($request);

        if($modulesForm->isValid()){

            $modulesManager = $this->get('moocsy.modules_manager');

            $modulesManager->update($module);

            $this->get('artesanus.flashers')->add('info','El módulo se ha actualizado');

            return $this->redirect($this->generateUrl('moocsy_admin_course_module', array(
                'course' => $course->getSlug(),
                'module' => $module->getSlug(),
            )));
        }

        return $this->render('MoocsyBundle:Modules:module.html.twig', array(
            'course'       => $module->getCourses(),
            'modules_form' => $modulesForm->createView(),
            'module'       => $module
        ));
    }

    public function deleteAction($course, $module, Request $request)
    {

        $modulesManager = $this->get('moocsy.modules_manager');

        $module = $modulesManager->findOneModuleCourse($course, $module);

        $modulesManager->delete($module);

        $this->get('artesanus.flashers')->add('warning','Se ha eliminado un módulo');

        return $this->redirect($this->generateUrl('moocsy_admin_course', array('course' => $module->getCourses()->getSlug())));

        // if($modulesForm->isValid()){
        //
        //     $modulesManager = $this->get('moocsy.modules_manager');
        //
        //     $modulesManager->update($module);
        //
        //     $this->get('artesanus.flashers')->add('info','El módulo se ha actualizado');
        //
        //     return $this->redirect($this->generateUrl('moocsy_admin_course_module', array(
        //         'course' => $course->getSlug(),
        //         'module' => $module->getSlug(),
        //     )));
        // }
        //
        // return $this->render('MoocsyBundle:Modules:module.html.twig', array(
        //     'course'       => $module->getCourses(),
        //     'modules_form' => $modulesForm->createView(),
        //     'module'       => $module
        // ));
    }
}
