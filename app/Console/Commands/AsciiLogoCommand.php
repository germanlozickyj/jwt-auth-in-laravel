<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AsciiLogoCommand extends Command
{
    protected $signature = 'ascii:logo';

    public function handle(): void
    {
                $art = <<<ART
    ________                                          _________
    __  ____/__________________ _________ _______      ___  __ \_______   __
    _  / __ _  _ \_  ___/_  __ `__ \  __ `/_  __ \     __  / / /  _ \_ | / /
    / /_/ / /  __/  /   _  / / / / / /_/ /_  / / /     _  /_/ //  __/_ |/ / 
    \____/  \___//_/    /_/ /_/ /_/\__,_/ /_/ /_/      /_____/ \___/_____/   

ART;
        $this->line("\n".$art."\n");
    }
}
