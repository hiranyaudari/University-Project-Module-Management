<?php

use App\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:21 PM
 */

class ProjectTableSeeder extends Seeder{

    public function run()
    {
        Model::unguard();

        Project::create([
            'title' => 'EyeMotion Detection System',
            'description' => 'Blah Blah Blah.... :P',
            'supervisorID' => 1,
            'studentID' => 1,
            'status' => 'Approved'
        ]);

        Project::create([
            'title' => 'Vehicle Navigation System',
            'description' => 'Ring ringaring ring... :P',
            'supervisorID' => 2,
            'studentID' => 2,
            'status' => 'Approved'
        ]);

        Project::create([
            'title' => 'Tamil BlindReader System',
            'description' => 'Ba Ba Ba ... Baabababa.... Eyemotion :P',
            'supervisorID' => null,
            'studentID' => 3,
            'status' => 'Pending'
        ]);

        Project::create([
            'title' => 'Virtual Campus System',
            'description' => 'Woooow... :P',
            'supervisorID' => 2,
            'studentID' => 3,
            'status' => 'Approved'
        ]);

        Project::create([
            'title' => 'Child Tracking System',
            'description' => 'Aiyo... :P',
            'supervisorID' => null,
            'studentID' => 4,
            'status' => 'Rejected'
        ]);

        Project::create([
            'title' => 'Virtual Reality Simulation',
            'description' => 'Apoi... :P',
            'supervisorID' => 1,
            'studentID' => 4,
            'status' => 'Pending'
        ]);

        Project::create([
            'title' => 'Location Based Social Networking',
            'description' => 'Location Based Social Networking',
            'supervisorID' => 2,
            'studentID' => 5,
            'status' => 'Proposal Evaluated'
        ]);

        Project::create([
            'title' => 'Cognitive Machine Learning',
            'description' => 'Cognitive Machine Learning',
            'supervisorID' => 1,
            'studentID' => 4,
            'status' => 'Proposal Evaluated'
        ]);

        Project::create([
            'title' => 'Location Based Advertising',
            'description' => 'Location Based Advertising',
            'supervisorID' => 1,
            'studentID' => 5,
            'status' => 'Proposal Evaluated'
        ]);

    }
}