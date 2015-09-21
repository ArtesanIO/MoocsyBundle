<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class QuestionsController extends Controller
{

    public function newAction($course, $module, $item, $quiz, Request $request)
    {

        $quizManager = $this->get('moocsy.items_quiz_manager');

        $quiz = $quizManager->findQuizItemModuleCourse($quiz, $item, $module, $course);

        if(null === $quiz){
            $this->get('artesanus.flashers')->add('warning','El recurso al que quieres acceder no existe');
            return $this->redirect($this->generateUrl('moocsy_admin_courses'));
        }

        $item   = $quiz->getItems();
        $module = $item->getModules();
        $course = $module->getCourses();

        $QuestionsManager = $this->get('moocsy.questions_manager');

        $questions = $QuestionsManager->create();

        $questionForm = $this->createForm('moocsy_questions_type', $questions)->handleRequest($request);

        if($questionForm->isValid()){

            $questions->setItemsQuiz($quiz);
            $questions = $QuestionsManager->save($questions);

            $this->get('artesanus.flashers')->add('info','Se ha creado una pregunta');

            return $this->redirect($this->generateUrl('moocsy_admin_course_module_item', array(
                'course' => $course->getSlug(),
                'module' => $module->getSlug(),
                'item'   => $item->getSlug()
            )));
        }

        return $this->render('MoocsyBundle:Questions:questions-new.html.twig', array(
            'course'           => $course,
            'module'           => $module,
            'item'             => $item,
            'questions_form'   => $questionForm->createView()
        ));
    }

    public function questionAction($course, $module, $item, $quiz, $question, Request $request)
    {

        $questionsManager = $this->get('moocsy.questions_manager');

        $question = $questionsManager->findQuestionQuizItemModuleCourse($question, $quiz, $item, $module, $course);

        if(null === $question){
            $this->get('artesanus.flashers')->add('warning','El recurso al que quieres acceder no existe');
            return $this->redirect($this->generateUrl('moocsy_admin_courses'));
        }

        $quiz   = $question->getItemsQuiz();
        $item   = $quiz->getItems();
        $module = $item->getModules();
        $course = $module->getCourses();

        $optionsOriginales = $questionsManager->optionsOriginales($question);

        $questionForm = $this->createForm('moocsy_questions_type', $question)->handleRequest($request);

        if($questionForm->isValid()){

            $questions = $questionsManager->update();

            $this->get('artesanus.flashers')->add('info','Se ha actualizado la pregunta');

            return $this->redirect($this->generateUrl('moocsy_admin_course_modules_items_quiz_question', array(
                'course'    => $course->getSlug(),
                'module'    => $module->getSlug(),
                'item'      => $item->getSlug(),
                'quiz'      => $quiz->getId(),
                'question'  => $question->getId()
            )));
        }

        $questionsOptionsForm = $this->createForm('moocsy_questions_options_type', $question)->handleRequest($request);

        if($questionsOptionsForm->isValid()){

            foreach($question->getOptions() as $opcion){
                $opcion->setQuestions($question);
            }

            $questionsManager->updateQuestionsOptions($question, $optionsOriginales);

            $this->get('artesanus.flashers')->add('info','Se han actualizado las Opciones de la Pregunta');

            return $this->redirect($this->generateUrl('moocsy_admin_course_modules_items_quiz_question', array(
                'course'    => $course->getSlug(),
                'module'    => $module->getSlug(),
                'item'      => $item->getSlug(),
                'quiz'      => $quiz->getId(),
                'question'  => $question->getId()
            )));
        }

        return $this->render('MoocsyBundle:Questions:question.html.twig', array(
            'course'                        => $module->getCourses(),
            'module'                        => $module,
            'item'                          => $item,
            'quiz'                          => $quiz,
            'question'                      => $question,
            'questions_form'                => $questionForm->createView(),
            'questions_options_form'        => $questionsOptionsForm->createView(),
        ));
    }

    public function deleteAction($course, $module, $item, $quiz, $question, Request $request)
    {

        $questionsManager = $this->get('moocsy.questions_manager');

        $question = $questionsManager->findQuestionQuizItemModuleCourse($question, $quiz, $item, $module, $course);

        if(null === $question){
            $this->get('artesanus.flashers')->add('warning','El recurso al que quieres acceder no existe');
            return $this->redirect($this->generateUrl('moocsy_admin_courses'));
        }

        $quiz   = $question->getItemsQuiz();
        $item   = $quiz->getItems();
        $module = $item->getModules();
        $course = $module->getCourses();

        $questionsManager->delete($question);

        $this->get('artesanus.flashers')->add('warning','Se ha eliminado una pregunta');

        return $this->redirect($this->generateUrl('moocsy_admin_course_module_item', array(
            'course' => $module->getCourses()->getSlug(),
            'module' => $module->getSlug(),
            'item'   => $item->getSlug()
        )));

        // $optionsOriginales = $questionsManager->optionsOriginales($question);
        //
        // $questionForm = $this->createForm('moocsy_questions_type', $question)->handleRequest($request);
        //
        // if($questionForm->isValid()){
        //
        //     $questions = $questionsManager->update();
        //
        //     $this->get('artesanus.flashers')->add('info','Se ha actualizado la pregunta');
        //
        //     return $this->redirect($this->generateUrl('moocsy_admin_course_modules_items_quiz_question', array(
        //         'course'    => $course->getSlug(),
        //         'module'    => $module->getSlug(),
        //         'item'      => $item->getSlug(),
        //         'quiz'      => $quiz->getId(),
        //         'question'  => $question->getId()
        //     )));
        // }
        //
        // $questionsOptionsForm = $this->createForm('moocsy_questions_options_type', $question)->handleRequest($request);
        //
        // if($questionsOptionsForm->isValid()){
        //
        //     foreach($question->getOptions() as $opcion){
        //         $opcion->setQuestions($question);
        //     }
        //
        //     $questionsManager->updateQuestionsOptions($question, $optionsOriginales);
        //
        //     $this->get('artesanus.flashers')->add('info','Se han actualizado las Opciones de la Pregunta');
        //
        //     return $this->redirect($this->generateUrl('moocsy_admin_course_modules_items_quiz_question', array(
        //         'course'    => $course->getSlug(),
        //         'module'    => $module->getSlug(),
        //         'item'      => $item->getSlug(),
        //         'quiz'      => $quiz->getId(),
        //         'question'  => $question->getId()
        //     )));
        // }
        //
        // return $this->render('MoocsyBundle:Questions:question.html.twig', array(
        //     'course'                        => $module->getCourses(),
        //     'module'                        => $module,
        //     'item'                          => $item,
        //     'quiz'                          => $quiz,
        //     'question'                      => $question,
        //     'questions_form'                => $questionForm->createView(),
        //     'questions_options_form'        => $questionsOptionsForm->createView(),
        // ));
    }
}
