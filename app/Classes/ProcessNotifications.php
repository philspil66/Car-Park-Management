<?php namespace App\Classes;

use Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProcessNotifications extends EST {
    

    public static function process() {
        
        Log::info('============================');
        Log::info('Sending Email Reminders');
        
        if ( env('REMINDERS_SEND_1_WEEK', 0) ) {
            self::oneWeekEmailReminder();
        }
        
        if ( env('REMINDERS_SEND_1_DAY', 0) ) {
            self::oneDayEmailReminder();
        }
        
        if ( env('REMINDERS_ON_THE_DAY', 0) ) {
            self::onTheDayEmailReminder();
        }
        
        Log::info('============================');
    }
    
    private static function oneWeekEmailReminder() {
        
        Log::info('----------------------------');
        Log::info('WEEKLY');
        Log::info('----------------------------');
        
        // get target date - date for which we need to check/send reminders
        
        $dayIs = strtolower( date('l') );
        $cToday = Carbon::now();
        
        if (  $dayIs == _REMINDER_FRI_ ) {
        // If today is Friday then send out emails for next Sat (+8 days) & Sun (+9 days)
        // 
            
            // Send out emails for relevant events on next Fri (+7 days)
            $targetDate = $cToday->addDay(7)->format('Y-m-d');
            Log::info('Today is '.$dayIs.', so sending out emails for events on: '.$dayIs.' '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1WEEK_REMINDER_ );
            
            // Send out emails for relevant events on next Sat (+8 days)
            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is friday so sending out emails for events on: Sat '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1WEEK_REMINDER_ );
            
            // Send out emails for relevant events on next Sun (+9 days)
            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is friday so sending out emails for events on: Sun '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1WEEK_REMINDER_ );
            
            
        } elseif ( strpos( _REMINDER_SAT_SUN_, $dayIs ) === FALSE ) {
        // If today is NOT Friday & NOT SAT/SUN then today must be MON-THU so 
        // send out emails for same day next week (+7 days)
        // 
            
            
            $targetDate = $cToday->addDay(7)->format('Y-m-d');
            Log::info('Today is '.$dayIs.', so sending out emails for events on: '.$dayIs.' '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1WEEK_REMINDER_ );
            
        } else {
            Log::info('Today is '.$dayIs.', so ignoring any weekly reminders.');
        }
        
    }
    
    private static function oneDayEmailReminder() {
        
        Log::info('----------------------------');
        Log::info('ONE DAY');
        Log::info('----------------------------');
        
        $dayIs = strtolower( date('l') );
        $cToday = Carbon::now();
        
        // If today is Friday then send out emails for Sat (+1 day) & Sun (+2 days)
        // 
        if (  $dayIs == _REMINDER_FRI_ ) {
            
            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is friday so checking if any email reminders need going out for Sat '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1DAY_REMINDER_ );
            
            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is friday so checking if any email reminders need going out for Sun '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1DAY_REMINDER_ );
            
            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is friday so checking if any email reminders need going out for Mon '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1DAY_REMINDER_ );
            
        } elseif ( strpos( _REMINDER_SAT_SUN_, $dayIs ) === FALSE ) {

            $targetDate = $cToday->addDay(1)->format('Y-m-d');
            Log::info('Today is '.$dayIs.', so checking if any email reminders need going out for '.$dayIs.' '.$targetDate);
            self::sendRemindersForTargetDate( $targetDate, _TEMPLATES_1DAY_REMINDER_ );
            
        } else {
            Log::info('Today is '.$dayIs.', so ignoring any one day reminders.');
        }
        
    }
    
    private static function onTheDayEmailReminder() {
        
        Log::info('----------------------------');
        Log::info('ON THE DAY');
        Log::info('----------------------------');
        
        $dayIs = strtolower( date('l') );
        $cToday = Carbon::now();

        $targetDate = $cToday->format('Y-m-d');

        Log::info('Today is '.$dayIs.', so checking if any email reminders need going out for '.$dayIs.' '.$targetDate);
        
        self::sendRemindersForTargetDate($targetDate, _TEMPLATES_0DAY_REMINDER_ );
    }
    
    
    
    
    private static function sendRemindersForTargetDate( $targetDate, $emailTemplate ) {
        
        
        $arrEvents = \App\Classes\Event::eventsForDateWithNoPlate( $targetDate );

        if ( !count($arrEvents) ) {            
            Log::info('No relevant emails need going out for the target date.');
        } else {
            Log::info(count($arrEvents).' relevant emails need going out for the target date.');   
            Log::info('Sending any applicable reminders for event: '.$arrEvents[0]['eventTitle']);
        }
        
        foreach($arrEvents as $event) {
/*            
            echo '<pre>';
            print_r($event);
            echo '</pre>';
*/            
            $User = User::find( $event['usersId'] );
            
            if ( !$User || Tools::isPhoneBooking($User->email) ) {
                //
                // If User object not found OR it's a phone booking then skip 
                continue;
            }
            
            $weekEmail = new Postman( $User );
            if ( $emailTemplate == _TEMPLATES_1WEEK_REMINDER_ ) {
                $weekEmail->sendEmailFor1WeekReminder($event);
                
            } elseif ( $emailTemplate == _TEMPLATES_1DAY_REMINDER_ ) {
                $weekEmail->sendEmailFor1DayReminder($event);
                
            } elseif ( $emailTemplate == _TEMPLATES_0DAY_REMINDER_ ) {
                $weekEmail->sendEmailForOnTheDayReminder($event);
                
            }
        }
        
    }
        
}