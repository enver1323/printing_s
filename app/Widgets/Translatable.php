<?php

namespace App\Widgets;

use App\Domain\Translation\Entities\Language;
use Arrilot\Widgets\AbstractWidget;

class Translatable extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'name' => 'name',
        'input' => 'input',
        'translation' => 'translation',
        'entries' => [],
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.translatable', [
            'name' => $this->config['name'],
            'input' => $this->config['input'],
            'entries' => $this->config['entries'],
            'translation' => $this->config['translation'],
            'languages' => Language::all(),
        ]);
    }
}
