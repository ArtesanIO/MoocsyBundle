<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ItemsController extends Controller
{

    public function newAction($course, $module, Request $request)
    {

        $module = $this->get('moocsy.modules_manager')->findOneModuleCourse($course, $module);

        $itemsManager = $this->get('moocsy.items_manager');

        $items = $itemsManager->create();

        $itemsForm = $this->createForm('moocsy_items_type', $items)->handleRequest($request);

        if($itemsForm->isValid()){

            $items->setModules($module);
            $items = $itemsManager->save($items);

            $this->get('artesanus.flashers')->add('info','Se ha creado un ítem');

            return $this->redirect($this->generateUrl('moocsy_admin_course_module', array(
                'course' => $module->getCourses()->getSlug(),
                'module' => $module->getSlug()
            )));
        }

        return $this->render('MoocsyBundle:Items:items-new.html.twig', array(
            'course'     => $module->getCourses(),
            'module'     => $module,
            'item'       => $items,
            'items_form' => $itemsForm->createView()
        ));
    }

    public function editAction($course, $module, $item, Request $request)
    {

        $itemsManager = $this->get('moocsy.items_manager');

        $item = $itemsManager->findOneItemModuleCourse($course, $module, $item);

        $module = $item->getModules();

        $itemsForm = $this->createForm('moocsy_items_type', $item)->handleRequest($request);

        if($itemsForm->isValid()){

            $items = $itemsManager->update($item);

            $this->get('artesanus.flashers')->add('info','Se ha actualizado el ítem');

            return $this->redirect($this->generateUrl('moocsy_admin_course_module_item', array(
                'course' => $module->getCourses()->getSlug(),
                'module' => $module->getSlug(),
                'item'   => $item->getSlug()
            )));
        }

        $itemsTypesManager = $this->get('moocsy.items_types_manager');

        $itemType = $item->getItemsType();

        $itemsTypesEntity = $itemsTypesManager->itemsTypesEntity($item);

        $itemsTypesForm = $itemsTypesManager->itemsTypesForm($itemType, $itemsTypesEntity);

        $itemsTypesForm->handleRequest($request);

        if($itemsTypesForm->isValid()){

            $itemsTypesEntity->setItems($item);

            $itemsTypesManager->persistItemsType($itemType, $itemsTypesEntity);

            $this->get('artesanus.flashers')->add('info','Se ha actualizado el valor del ítem');

            return $this->redirect($this->generateUrl('moocsy_admin_course_module_item', array(
                'course' => $module->getCourses()->getSlug(),
                'module' => $module->getSlug(),
                'item'   => $item->getSlug()
            )));

        }

        return $this->render('MoocsyBundle:Items:item.html.twig', array(
            'course' => $module->getCourses(),
            'module' => $module,
            'item'   => $item,
            'items_form' => $itemsForm->createView(),
            'items_types_form' => $itemsTypesForm->createView(),
            'items_entity' => $itemsTypesEntity
        ));
    }

    public function deleteAction($course, $module, $item, Request $request)
    {

        $itemsManager = $this->get('moocsy.items_manager');

        $item = $itemsManager->findOneItemModuleCourse($course, $module, $item);

        $module = $item->getModules();

        $itemsManager->delete($item);

        $this->get('artesanus.flashers')->add('warning','Se ha eliminado un Ítem');

        return $this->redirect($this->generateUrl('moocsy_admin_course_module', array(
            'course' => $module->getCourses()->getSlug(),
            'module' => $module->getSlug(),
        )));

    }
}
