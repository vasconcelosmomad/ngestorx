<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ProdutoExport implements FromCollection, WithHeadings, WithCustomStartCell, WithEvents, ShouldAutoSize
{
    protected $table;
    protected $empresa;

    public function __construct($table, $empresa)
    {
        $this->table = $table;
        $this->empresa = $empresa;
    }

    /**
    * Retorna os dados para exportação
    *
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        return DB::table($this->table)
            ->select('codigo', 'nome', 'estoque')
            ->where('status', 'Ativo')
            ->get();
    }

    /**
    * Define os cabeçalhos das colunas
    *
    * @return array
    */
    public function headings(): array
    {
        return ['Código', 'Nome do Produto', 'Quantidade em Estoque'];

    }

    /**
    * Define a célula inicial dos dados (depois do cabeçalho customizado)
    */
    public function startCell(): string
    {
        return 'A6'; // Os dados começarão na linha 6
    }

    /**
    * Personaliza o conteúdo e estilo do Excel
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // Adicionando informações no cabeçalho
                $sheet->mergeCells('A1:D1'); // Mesclar células para o título principal
                $sheet->setCellValue('A1', 'Catálogo de Produtos'); // Título principal
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);

                $sheet->mergeCells('A2:D2'); // Mesclar para o nome da empresa
                $sheet->setCellValue('A2', session('nome_empresa')); // Nome da empresa
                $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);

                $sheet->mergeCells('A3:D3'); // Mesclar para a data
                $sheet->setCellValue('A3', 'Data: ' . now()->format('d/m/Y')); // Data atual
                $sheet->getStyle('A3')->getFont()->setSize(12);
                $sheet->mergeCells('A4:D4'); // Mesclar para o nome da empresa

                // Estilizando os cabeçalhos
                $sheet->getStyle('A6:D6')->getFont()->setBold(true); // Linha dos cabeçalhos
            },
        ];
    }
}
