<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Model\ItemsAudioManager;
use ArtesanIO\MoocsyBundle\Model\ItemsAudioDownloadManager;
use ArtesanIO\MoocsyBundle\Model\ItemsFileManager;
use ArtesanIO\MoocsyBundle\Model\ItemsForumManager;
use ArtesanIO\MoocsyBundle\Model\ItemsTypes;
use ArtesanIO\MoocsyBundle\Event\ItemsTypesEvent;
use ArtesanIO\MoocsyBundle\Model\ItemsVideoManager;
use ArtesanIO\MoocsyBundle\Model\ItemsQuizManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;



class ItemsTypesManager extends ContainerAware
{

    protected $itemsTypes;
    protected $audio;
    protected $audio_down;
    protected $file;
    protected $forum;
    protected $video;
    protected $quiz;

    public function __construct(ItemsTypes $types, ItemsAudioManager $audio, ItemsAudioDownloadManager $audio_down, ItemsFileManager $file, ItemsForumManager $forum, ItemsVideoManager $video, ItemsQuizManager $quiz)
    {
        $this->itemsTypes   = $types;
        $this->audio        = $audio;
        $this->audio_down   = $audio_down;
        $this->file         = $file;
        $this->forum        = $forum;
        $this->video        = $video;
        $this->quiz         = $quiz;
    }

    public function getItemsTypes()
    {
        $this->container->get('event_dispatcher')->dispatch(
            MoocsyEvents::MOOCSY_ITEMS_TYPE, new ItemsTypesEvent($this->itemsTypes)
        );

        return $this->itemsTypes->getItemsTypes();
    }

    public function itemsTypesForm($type, $entityItemsTypes)
    {
        $form = $this->container->get('form.factory');

        return $form->create($this->container->get('moocsy.'.$type.'_type'), $entityItemsTypes);

    }

    public function itemsTypesEntity($item)
    {
        switch ($item->getItemsType()) {
            case 'items_audio':

                if($this->audio->findOneByItems($item)){
                    return $this->audio->findOneByItems($item);
                }
                return $this->audio->create();

                break;

            case 'items_audio_down':
                if($this->audio_down->findOneByItems($item)){
                    return $this->audio_down->findOneByItems($item);
                }
                return $this->audio_down->create();

                break;

            case 'items_file':
                if($this->file->findOneByItems($item)){
                    return $this->file->findOneByItems($item);
                }
                return $this->file->create();

                break;

            case 'items_forum':
                if($this->forum->findOneByItems($item)){
                    return $this->forum->findOneByItems($item);
                }
                return $this->forum->create();

                break;
            case 'items_video':

                if($this->video->findOneByItems($item)){
                    return $this->video->findOneByItems($item);
                }
                return $this->video->create();

                break;
            case 'items_quiz':

                if($this->quiz->findOneByItems($item)){
                    return $this->quiz->findOneByItems($item);
                }
                return $this->quiz->create();

                break;
            default:
                # code...
                break;
        }
    }

    public function persistItemsType($type, $model)
    {
        switch ($type) {
            case 'items_audio':
                return $this->audio->save($model);
                break;
            case 'items_audio_down':
                return $this->audio_down->save($model);
                break;
            case 'items_file':
                return $this->file->save($model);
                break;
            case 'items_forum':
                return $this->forum->save($model);
                break;
            case 'items_video':
                return $this->video->save($model);
                break;
            case 'items_quiz':
                return $this->quiz->save($model);
                break;
            default:
                # code...
                break;
        }
    }
}

?>
