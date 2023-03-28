<?php

namespace App\Exports;

use App\Models\Ideas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExcel implements FromCollection, WithHeadings
{
    private $topics_id;
    
    public function __construct($id){
        $this->topics_id = $id;
    }

    public function collection()
    {
        return Ideas::where('topics_id', $this->topics_id)->get();
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Text', 'File Path', 'Created_at', 'Updated_at', 'Views_count', 'Likes_count', 'Dislikes_count',
                'User_id', 'Topics_id', 'Departments_id', 'Categories_id'];
    }
}
