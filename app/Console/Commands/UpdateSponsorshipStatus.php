<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Orphan;
use App\Models\Sponsorship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
// use Log;
use App\Notifications\SponsorshipEnded;
use App\Notifications\SponsorshipEndingSoon;

class UpdateSponsorshipStatus extends Command
{
    protected $signature = 'sponsorships:update-status';

    protected $description = 'تحديث حالة الكفالات بناءً على انتهاء المدة أو بلوغ اليتيم 18 سنة';

    protected int $daysLeft = 0;

    public function handle()
    {
        $today = Carbon::today();

        $sponsorships = Sponsorship::where('role', 'active')->get();

        foreach ($sponsorships as $sponsorship) {


            $endDate = Carbon::parse($sponsorship->start_date)
                        ->addMonths($sponsorship->duration)
                        ->startOfDay();


            $this->daysLeft = $today->diffInDays($endDate, false);



            $orphan = $sponsorship->orphan;

            // إذا بلغ اليتيم 18 سنة
            if ($orphan && $orphan->birth_date) {
                $age = Carbon::parse($orphan->birth_date)->age;
                if ($age >= 18) {
                    $orphan->sponsorships()->update(['role' => 'Inactive']);
                    $orphan->update(['role' => 'archive']);
                    $this->notifyAboutSponsorship($sponsorship, 'ended');
                    continue;
                }
            }

            if ($orphan && $orphan->role === 'archive') {
                // تحديث جميع كفالاته إلى Inactive
                $orphan->sponsorships()->update(['role' => 'Inactive']);

                // إرسال إشعار 'finish' لجميع الكفالات
                foreach ($orphan->sponsorships as $s) {
                    $this->notifyAboutSponsorship($s, 'finish');
                }

                continue; // ننتقل للكفالة التالية
            }

            if ($sponsorship->status === 'تم التسليم' && $today->greaterThanOrEqualTo($endDate)) {
                $sponsorship->update(['role' => 'Inactive']);
                $this->notifyAboutSponsorship($sponsorship, 'finish');
            }

            $startDate = Carbon::parse($sponsorship->start_date);
            if ($startDate->month === $today->month && $startDate->year === $today->year) {
                $this->notifyAboutSponsorship($sponsorship, 'time_to_deliver');
            }




        }



    }

    protected function notifyAboutSponsorship(Sponsorship $sponsorship, string $type = 'soon'): void
    {
        $message = match ($type) {
            'ended' => "🔔 تم إنهاء الكفالة رقم {$sponsorship->id} لأن اليتيم {$sponsorship->orphan->name} بلغ 18 عامًا.",
            'finish' => "🔔تم إنهاء الكفالة رقم {$sponsorship->id} لأن اليتيم {$sponsorship->orphan->name} انتهت مدة الكفالة.",
            // 'soon' => "🔔 الكفالة رقم {$sponsorship->id} لليتيم {$sponsorship->orphan->name} ستنتهي بعد {$this->daysLeft} يومًا.",
            // 'not_delivered' => "⚠️ انتهت جميع كفالات اليتيم {$sponsorship->orphan->name}، والكفالة رقم {$sponsorship->id} لم تُسلَّم بعد. الرجاء تسليمها لضمان استمرار الكفالات .",
            'time_to_deliver' => "🔔 حان وقت تسليم الكفالة رقم {$sponsorship->id} لليتيم {$sponsorship->orphan->name}، حيث تبدأ اليوم مدة الكفالة.",

        };

        $notification = match ($type) {
            'ended', 'finish' => new SponsorshipEnded($sponsorship, $message),
            'time_to_deliver' => new SponsorshipEndingSoon($sponsorship, $message),
        };

        User::all()->each(function ($user) use ($notification) {
            $user->notify($notification);
        });

    }
}
