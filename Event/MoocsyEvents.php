<?php

namespace ArtesanIO\MoocsyBundle\Event;

final class MoocsyEvents
{
    const MOOCSY_COURSES_PRE_CREATE = 'moocsy.courses_pre_create';

    const MOOCSY_COURSES_PRE_UPDATE = 'moocsy.courses_pre_update';

    const MOOCSY_MODULES_PRE_CREATE = 'moocsy.modules_pre_create';

    const MOOCSY_MODULES_PRE_UPDATE = 'moocsy.modules_pre_update';

    const MOOCSY_ITEMS_PRE_CREATE   = 'moocsy.items_pre_create';

    const MOOCSY_ITEMS_PRE_UPDATE   = 'moocsy.items_pre_update';

    const MOOCSY_ITEMS_TYPE         = 'moocsy.items_types';

    const MOOCSY_TEMPORALITY        = 'moocsy.temporality';

    const MOOCSY_REQUEST_RESPONSE   = 'moocsy.request_response';
}

?>
