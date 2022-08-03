<?php

namespace App\Console\Commands;

use App\Mail\OrderFixed;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FixStudentsOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:students-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix students Order';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->info('Fixing students order...');
            $students = Student::all();
            $progress = $this->output->createProgressBar($students->count());
            $students_group = $students->groupBy('school_id');
            foreach ($students_group as $group) {
                $order = 1;
                foreach ($group as $student) {
                    $student->order = $order;
                    $student->save();
                    $order++;
                    $progress->advance();
                }
            }
            $progress->finish();
            $this->newLine(1);
            $this->info('Students order fixed.');
            $this->sendNotification();
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            $this->sendNotification(1);
            return 1;
        }
    }

    private function sendNotification($failed = 0)
    {
        Mail::to(User::all())->queue(new OrderFixed($failed ? 'failed' : 'success'));
    }

}
