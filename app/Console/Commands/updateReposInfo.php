<?php

namespace App\Console\Commands;

use App\Service\SaveReposDataService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class updateReposInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:reposData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日更新儲存庫資訊';

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
        $saveGitService = new SaveReposDataService;
        // $saveGitService->saveReposData();

        Log::info('update repos data success');
        $this->info('Git Repos info updated'); // 使用 info() 顯示終端機訊息
        return 0;
    }
}
