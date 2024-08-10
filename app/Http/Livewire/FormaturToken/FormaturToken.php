<?php

namespace App\Http\Livewire\FormaturToken;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class FormaturToken extends Component
{

    //  table data////////////////
    public $myToken;
    public $jmlmyTokenRender = 5;

    // limit record per page -resetExcept////////////////
    // public $limitPerPage = 5;



    //  modal status////////////////
    // public $isOpen = 0;
    // public $isOpenMode = 'insert';
    // public $tampilIsOpen = 0;


    // search logic -resetExcept////////////////
    // public $search;
    // protected $queryString = [
    //     'search' => ['except' => '', 'as' => 'cariData'],
    //     'page' => ['except' => 1, 'as' => 'p'],
    // ];


    // sort logic -resetExcept////////////////
    // public $sortField = 'token';
    // public $sortAsc = true;


    // listener from blade////////////////
    protected $listeners = [
        'confirm_remove_record_province' => 'delete',
    ];




    ////////////////////////////////////////////////
    ///////////begin////////////////////////////////
    ////////////////////////////////////////////////





    // resert input private////////////////
    // private function resetInputFields(): void
    // {
    //     $this->reset([
    //         'name',
    //         'province_id',

    //         'isOpen',
    //         'tampilIsOpen',
    //         'isOpenMode'
    //     ]);
    // }




    // open and close modal start////////////////
    // private function openModal(): void
    // {
    //     $this->resetInputFields();
    //     $this->isOpen = true;
    //     $this->isOpenMode = 'insert';
    // }
    // private function openModalEdit(): void
    // {
    //     $this->resetInputFields();
    //     $this->isOpen = true;
    //     $this->isOpenMode = 'update';
    // }

    // private function openModalTampil(): void
    // {
    //     $this->resetInputFields();
    //     $this->isOpen = true;
    //     $this->isOpenMode = 'tampil';
    // }

    // public function closeModal(): void
    // {
    //     $this->resetInputFields();
    // }
    // open and close modal end////////////////




    // setLimitPerpage////////////////
    // public function setLimitPerPage($value)
    // {
    //     $this->limitPerPage = $value;
    // }




    // resert page pagination when coloumn search change ////////////////
    // public function updatedSearch(): void
    // {
    //     $this->resetPage();
    // }




    // logic ordering record (shotby)////////////////
    // public function sortBy($field)
    // {
    //     if ($this->sortField === $field) {
    //         $this->sortAsc = !$this->sortAsc;
    //     } else {
    //         $this->sortAsc = true;
    //     }

    //     $this->sortField = $field;
    // }



    // is going to insert data////////////////
    public function create($jmlmyTokenRender): void
    {
        // cek sudah ada evoting yang masuk apa blm??
        $cekVoteMU = DB::table('votemu')->get()->count();

        if ($cekVoteMU > 0) {
            $this->emit('toastr-error', "Anda tidak bisa menambah token, Proses Pemilihan sedang berlangsung.");
        }

        if (!$jmlmyTokenRender) {
            $this->emit('toastr-error', "Jml Token Belum di isi.");
            return;
        }

        $i = 1;
        $randomToken = [];
        while ($i < $jmlmyTokenRender + 1) {
            $randomToken[$i]['token'] = Str::random(5);
            $i++;
        }

        DB::table('token')->insert($randomToken);
    }


    public function resetVoteMU(): void
    {

        DB::table('votemu')->delete();
    }



    // insert record start////////////////
    // public function store()
    // {

    //     $customErrorMessages = [
    //         'name.required' => 'Nama tidak boleh kosong',
    //         'province_id.required' => 'Kode tidak boleh kosong'
    //     ];

    //     $this->validate([
    //         'name' => 'required',
    //         'province_id' => 'required'
    //     ], $customErrorMessages);

    //     Province::updateOrCreate(['id' => $this->province_id], [
    //         'name' => $this->name
    //     ]);


    //     $this->closeModal();
    //     $this->resetInputFields();
    //     $this->emit('toastr-success', "Data " . $this->name . " berhasil disimpan.");
    // }
    // insert record end////////////////



    // Find data from table start////////////////
    // private function findData($value)
    // {
    //     $findData = Province::findOrFail($value);
    //     return $findData;
    // }
    // Find data from table end////////////////



    // show edit record start////////////////
    // public function edit($id)
    // {
    //     $this->openModalEdit();

    //     $province = $this->findData($id);
    //     $this->province_id = $id;
    //     $this->name = $province->name;
    // }
    // show edit record end////////////////



    // tampil record start////////////////
    // public function tampil($id)
    // {
    //     $this->openModalTampil();

    //     $province = $this->findData($id);
    //     $this->province_id = $id;
    //     $this->name = $province->name;
    // }
    // tampil record end////////////////



    // delete record start////////////////
    // public function delete($id, $name)
    // {
    //     Province::find($id)->delete();
    //     $this->emit('toastr-success', "Hapus data " . $name . " berhasil.");
    // }
    // delete record end////////////////



    // select data start////////////////
    public function render()
    {

        $myQData = DB::table('token')
            ->select(
                'token',
                DB::raw("(select count(*) from votemu where votemu.token=token.token) as token_status")
            )
            ->orderBy('token',  'asc')
            ->get();

        return view(
            'livewire.formatur-token.formatur-token',
            [
                'myQData' => $myQData,
                'myQDataCount' => $myQData->count(),
                'myTitle' => 'Master Token',
                'mySnipt' => 'Tambah Data Master Token',
                'myProgram' => 'Token',
                'myLimitPerPages' => [5, 10, 15, 20, 100]
            ]
        );
    }
    // select data end////////////////
}
