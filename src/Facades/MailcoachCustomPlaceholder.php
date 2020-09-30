<?php

namespace Timmoh\MailcoachCustomPlaceholder\Facades;

use Illuminate\Support\Facades\Facade;

class MailcoachCustomPlaceholder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mailcoach-custom-placeholder';
    }
}
