<?php

namespace AshrafSaeed\MakeFile;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeFileClient extends Command {
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'makef:file';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create files for Design patrens such as Factory, Builder, Prototype, Singleton, Adapter, Bridge and Repository Pattrens';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'makef:file {filename: file name with extention} {--path= :path where it should be add}';

    /**
     * Reset database configuration.
     */
    public function handle() {

        $userId = $this->argument('filename');

        // $dbName = 'lara_'.Str::slug(basename(base_path()), '_');
        
        // $replaces = [
        //     'lara_base_xxx' => $dbName,
        //     'lara_user_xxx' => mb_substr($dbName, 0, 16),
        //     'lara_pass_xxx' => Str::random(20),
        // ];

        // $this->writeFile('.env', $replaces);
        // $this->writeFile('config/database.php', $replaces);
        
        $this->info('DB successfully configured.');
    
    }

    /**
     * Reset database configuration.
     */
    protected function writeFile(string $relativeFilepath, array $replaces)
    {
        $filepath = base_path().'/'.$relativeFilepath;
        file_put_contents($filepath, strtr(
            file_get_contents($filepath),
            $replaces
        ));
    }
}