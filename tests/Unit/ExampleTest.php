<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductSchedule()
    {
        //https://www.freeformatter.com/cron-expression-generator-quartz.html
        $schedule = app()->make(\Illuminate\Console\Scheduling\Schedule::class);

        $events = collect($schedule->events())->filter(function (\Illuminate\Console\Scheduling\Event $event) {
            return stripos($event->command, 'products:sync');
        });

        if ($events->count() == 0) {
            $this->fail('No events found');
        }

        $events->each(function (\Illuminate\Console\Scheduling\Event $event) {
            $this->assertEquals('0 * * * *', $event->expression);
        });
    }
}
