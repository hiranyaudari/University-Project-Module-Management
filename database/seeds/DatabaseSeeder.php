<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//        $this->call('UserTableSeeder');
        $this->call('SentrySeeder');
        $this->call('StudentTableSeeder');
        $this->call('PanelMemberTableSeeder');
        $this->call('ProjectTableSeeder');
        $this->call('PresentationPanelTableSeeder');
        $this->call('FreeSlotsTableSeeder');
        $this->call('NoticesTableSeeder');
        $this->call('NotificationCategorySeeder');
        $this->call('ThesisPanelTableSeeder');
        $this->call('MonthlyReportsSeeder');
        $this->call('MonthlyReportsSupervisorFeedbackSeeder');
//        $this->call('Notification');
    }

}
