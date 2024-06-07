<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SecurityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update App Securities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('key:generate');
        Artisan::call('jwt:secret -f');

        $key = config('app.key');

        if ($key) {
            $keyArr = str_split($key);
            $appender = [
                [0, 0, 1, 1, 0, 0, 0, 0],
                [0, 1, 1, 1, 1, 0, 0, 0],
                [0, 0, 1, 1, 0, 0, 0, 0],
                [0, 0, 1, 1, 0, 0, 0, 0],
            ];
            $scramble = array();
            foreach ($keyArr as $index => $value) {
                $hexValue = bin2hex($value);
                $hexArr = str_split($hexValue);
                $hexArr[] = $index;
                $scramble[] = $hexArr;
            }
            $scramble = Arr::shuffle($scramble);

            $contents = 'function getAppender() { var appender = [';
            foreach ($appender as $value) {
                $strValue = implode(', ', $value);
                $contents .= '[' . $strValue . '], ';
            }
            $contents .= ']; return appender; } function getScrambler() { var scrambler = [';
            foreach ($scramble as $value) {
                $strValue = implode('", "', $value);
                $contents .= '["' . $strValue . '"], ';
            }
            $contents .= ']; return scrambler; }';

            if (Storage::disk('secure')->exists('secure.js')) {
                Storage::disk('secure')->delete('secure.js');
            }
            Storage::disk('secure')->put('secure.js', $contents);
        }

        Artisan::call('optimize:clear');

        shell_exec('npm run development');

        $this->info('Securities generated successfully');
    }
}
