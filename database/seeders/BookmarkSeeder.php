<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the test user
        $testUser = User::where('email', 'test123@gmail.com')->firstOrFail();

        // Get all the job_ids that are not under test user
        $jobIds = Job::where('user_id', '!=', $testUser->id)->pluck('id')->toArray();

        //Randomly select jobs to bookmark
        $randomJobIds = array_rand($jobIds,3);

        //Attach the selected jobs as bookmarks for the test user
        foreach($randomJobIds as $jobId){
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
