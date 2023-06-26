<?php

namespace App\Http\Livewire\FormaturHasil;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class FormaturHasil extends Component
{
    use WithPagination;

    //  table data////////////////
    public $table =
    [
        'no_urut' => "",
        'nama' => ""
    ];


    // limit record per page -resetExcept////////////////
    public $limitPerPage = 10;



    // search logic -resetExcept////////////////
    public $search;
    protected $queryString = [
        'search' => ['except' => '', 'as' => 'cariData'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];


    // sort logic -resetExcept////////////////
    public $sortField = 'vote_status';
    public $sortAsc = false;


    // listener from blade////////////////
    protected $listeners = [
        'confirm_remove_record_data' => 'delete',
    ];




    ////////////////////////////////////////////////
    ///////////begin////////////////////////////////
    ////////////////////////////////////////////////





    // resert input private////////////////
    private function resetInputFields(): void
    {
        $this->reset([
            'table',
        ]);
    }



    // setLimitPerpage////////////////
    public function setLimitPerPage($value)
    {
        $this->limitPerPage = $value;
    }




    // resert page pagination when coloumn search change ////////////////
    public function updatedSearch(): void
    {
        $this->resetPage();
    }




    // logic ordering record (shotby)////////////////
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }



    // select data start////////////////
    public function render()
    {
        return view(
            'livewire.formatur-hasil.formatur-hasil',
            [
                'calonFormatur' => DB::table('votemu')
                    ->select(
                        'votemu.no_urut as no_urut',
                        'calon_formatur.nama as nama',
                        DB::raw('count(votemu.no_urut) as vote_status')
                    )
                    ->join('calon_formatur', 'calon_formatur.no_urut', 'votemu.no_urut')
                    ->where('votemu.no_urut', 'like', '%' . $this->search . '%')
                    ->orWhere('calon_formatur.nama', 'like', '%' . $this->search . '%')
                    ->groupBy(
                        'votemu.no_urut',
                        'calon_formatur.nama',
                    )
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->limitPerPage),
                'myTitle' => 'Calon Formatur ',
                'mySnipt' => 'Hasil Voting Calon Formatur PDNA Tulungagung',
                'myProgram' => 'Calon Formatur',
                'myLimitPerPages' => [5, 10, 15, 20, 100]
            ]
        );
    }
    // select data end////////////////
}
