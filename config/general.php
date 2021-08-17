<?php

return [
    /**
     * View composers.
     */
    'composers' => [
        'rocXolid:communication::*' => Softworx\RocXolid\Communication\Composers\ViewComposer::class,
    ],
];