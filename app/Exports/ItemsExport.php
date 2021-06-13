<?php

namespace App\Exports;

use App\Models\Items;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements /* FromCollection ,*/ Responsable,ShouldAutoSize,WithMapping,WithHeadings,FromQuery
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    /*
    public function collection()
    {
        return Items::all();
    }
*/
    public function query()
    {
        return Items::query()->where('Name', $this->name);
    }

    public function headings(): array
    {

        return [
            'Name','SerialNum','Quantity'
        ];
    }

    public function map($item):array{
        return [
            $item->Name,
            $item->SerialNum,
            $item->Quantity

        ];
    }
}
