<?php

namespace App\Console\Commands;

use App\Models\Character;
use Illuminate\Console\Command;
use Njaaazi\BreakingBad\Facades\BreakingBad;

class StoreCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:characters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command gets characters from BreakingBad API and stores them in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $characters = collect(BreakingBad::characters()->all());

        $bar = $this->output->createProgressBar(count($characters));

        $bar->start();

        $characters->map(function ($character) use ($bar){
            Character::create([
                'name' => $character->name,
                'birthday' => $character->birthday,
                'occupation' => $character->occupation,
                'img' => $character->img,
                'status' => $character->status,
                'nickname' => $character->nickname,
                'appearance' => $character->appearance,
                'portrayed' => $character->portrayed,
                'category' => $character->category,
             ]);

            $bar->advance();
        });

        $bar->finish();

        $this->newLine();

        $this->info('Breaking Bad characters were saved successfully!');

        return 0;
    }
}
