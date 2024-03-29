<?php

namespace Softworx\RocXolid\Communication\Events\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable as Notification;
// rocXolid common models
use Softworx\RocXolid\Common\Models\Language;

/**
 * Interface to enable event to be further passed to a sending service.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
interface Sendable
{
    /**
     * Retrieve notification types supported by the event.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getNotificationTypes(): Collection;

    /**
     * Retrieve the recipients to send notification to.
     *
     * @param \Softworx\RocXolid\Communication\Models\Contracts\Sendable $notification
     * @return \Illuminate\Support\Collection
     */
    public function getRecipients(Notification $notification): Collection;

    /**
     * Retrieve the variables that are available to the blade content.
     *
     * @return array
     */
    public function getSendableVariables(): array;

    /**
     * Retrieve the sending model (the model that is assigned to the event).
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSendingModel(): Model;

    /**
     * Retrieve Language reference.
     *
     * @return \Softworx\RocXolid\Common\Models\Language|null
     */
    public function getLanguage(): ?Language;
}
