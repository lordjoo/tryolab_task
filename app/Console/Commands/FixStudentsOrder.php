<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;

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
        return 0;
    }
}
