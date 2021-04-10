<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DownloadCharactersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:download';
    
    private $character_repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->character_repository = new CharacterRepository(new Character);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $number_of_saved = 0;
        $page = 1;
        while($number_of_saved < 50) {
            $characters = Http::get('https://www.anapioficeandfire.com/api/characters', [
                'page' => $page
            ])->json();


            foreach($characters as $character) {
                if($character['name'] && $number_of_saved < 50) {
                    $character_data = array_intersect_key($character, array_flip([
                        'url', 'name', 'gender', 'culture', 'born', 'died', 'father', 'mother', 'spouse'
                    ]));
                    $new_character = $this->character_repository->create($character_data);
                    $character_id = $new_character->id;
                    $this->character_repository->setTitles($character['titles'], $character_id);
                    $number_of_saved++;
                }
            }
            $page++;
        }
        return 0;
    }
}
