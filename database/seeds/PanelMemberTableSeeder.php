<?php
use App\PanelMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: pranavaghanan
 * Date: 5/8/15
 * Time: 12:20 PM
 */

class PanelMemberTableSeeder extends Seeder {

    public function run()
    {
        Model::unguard();

        PanelMember::create([
            'name' => 'John Doe',
            'designation' => 'Senior Lecturer',
            'email' => 'johndoe@testt.lk',
            'phone' => '0758965896',
            'speciality' => 'Robotics',
            'type' => 'Internal Supervisor',
            'status' => 'Approved',
            'university' => 'SLIIT',
            'username' => 'johnd',
            'cv' => null
        ]);

        PanelMember::create([
            'name' => 'Martin Walker',
            'designation' => 'Assistant Lecturer',
            'email' => 'mwalker@testt.lk',
            'phone' => '0778956896',
            'speciality' => 'Image Processing',
            'type' => 'Internal Supervisor',
            'status' => 'Approved',
            'university' => 'SLIIT',
            'username' => 'martinw',
            'cv' => null
        ]);

        PanelMember::create([
            'name' => 'Jane Doe',
            'designation' => 'Lecturer',
            'email' => 'janedoe@testt.lk',
            'phone' => '0777652865',
            'speciality' => 'Database Administration',
            'type' => 'External Supervisor',
            'status' => 'Pending',
            'university' => 'Curtin',
            'username' => 'janed',
            'cv' => null
        ]);

        PanelMember::create([
            'name' => 'Alan During',
            'designation' => 'Senior Lecturer',
            'email' => 'aduring@testt.lk',
            'phone' => '0786457895',
            'speciality' => 'Robotics',
            'type' => 'External Supervisor',
            'status' => 'Approved',
            'university' => 'UoJ',
            'username' => 'aland',
            'cv' => null
        ]);

        PanelMember::create([
            'name' => 'Vasanthi Kariyavasam',
            'designation' => 'Assistant',
            'email' => 'vasanthik@testt.lk',
            'phone' => '0769586522',
            'speciality' => 'Nothing',
            'type' => 'RPC',
            'status' => 'Approved',
            'university' => 'SLIIT',
            'username' => 'vasanthik',
            'cv' => null
        ]);

        PanelMember::create([
            'name' => 'Russel Arnold',
            'designation' => 'Lecturer',
            'email' => 'russela@testt.lk',
            'phone' => '0725689657',
            'speciality' => 'Telecommunications',
            'type' => 'Internal Supervisor',
            'status' => 'Approved',
            'university' => 'SLIIT',
            'username' => 'russela',
            'cv' => null
        ]);
    }
}