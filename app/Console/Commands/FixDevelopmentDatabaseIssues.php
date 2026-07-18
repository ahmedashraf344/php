<?php

namespace App\Console\Commands;

use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Disclosure;
use App\Models\DisclosureUser;
use App\Models\KPIFormSignature;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\MeetingType;
use App\Models\Mozkra;
use App\Models\Position;
use App\Models\Resolution;
use App\Models\Setting;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FixDevelopmentDatabaseIssues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:development-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix issues in database columns during development phase';

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
     * @return mixed
     */
    public function handle()
    {
//        $this->fixLogHistoryIssues();
    }
}
