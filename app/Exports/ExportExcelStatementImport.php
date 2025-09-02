<?php

namespace App\Exports;

use App\Models\Sponsorship;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportExcelStatementImport implements FromCollection, WithHeadings, WithDrawings
{
    protected $ids;
    protected $sponsorships;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        // نسترجع البيانات
        $this->sponsorships = Sponsorship::whereIn('id', $this->ids)
            ->with(['orphan' => function ($query) {
                $query->select('id', 'name', 'id_number', 'orphan_code');
            }])
            ->get();

        return $this->sponsorships->map(function ($sponsorship) {
            return [
                $sponsorship->orphan->name,
                $sponsorship->orphan->id_number,
                $sponsorship->orphan->orphan_code,
                $sponsorship->duration,
                $sponsorship->start_date ?? '',
                $sponsorship->start_date
                    ? \Carbon\Carbon::parse($sponsorship->start_date)->copy()->addMonths($sponsorship->duration)->toDateString()
                    : '',
                $sponsorship->amount,
                number_format(floatval($sponsorship->amount) * intval($sponsorship->duration)) ?? '',
                $sponsorship->status,
                // حط مكان الصورة نص مؤقت (لترتيب الأعمدة)
                'الصورة مرفقة'
            ];
        });
    }

    public function headings(): array
    {
        return [
            'اسم اليتيم',
            'رقم الهوية',
            'كود اليتيم',
            'مدة الكفالة (بالأشهر)',
            'تاريخ البداية',
            'تاريخ النهاية',
            'مبلغ الكفالة الشهري',
            'المبلغ الإجمالي',
            'حالة الكفالة',
            'الإيصال'
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 2; // بعد الصف الأول (العناوين)

        foreach ($this->sponsorships as $sponsorship) {
            if ($sponsorship->payment_receipt) {
                $drawing = new Drawing();
                $drawing->setName('Receipt');
                $drawing->setDescription('صورة الإيصال');
                // الصورة محفوظة في storage/app/public
                $drawing->setPath(storage_path('app/public/' . $sponsorship->payment_receipt));
                $drawing->setHeight(80);
                $drawing->setCoordinates('J' . $row); // العمود J لأن العمود العاشر هو "الإيصال"

                $drawings[] = $drawing;
            }
            $row++;
        }

        return $drawings;
    }
}
