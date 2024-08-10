<?php

namespace App\Http\Livewire\CalonFormatur;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class CalonFormatur extends Component
{
    use WithPagination;
    use WithFileUploads;

    //  table data////////////////
    public $photo;
    public $table =
    [
        'no_urut' => "",
        'nama' => "",
        'poto' => ""
    ];


    // limit record per page -resetExcept////////////////
    public $limitPerPage = 5;



    //  modal status////////////////
    public $isOpen = 0;
    public $isOpenMode = 'insert';
    public $tampilIsOpen = 0;


    // search logic -resetExcept////////////////
    public $search;
    protected $queryString = [
        'search' => ['except' => '', 'as' => 'cariData'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];


    // sort logic -resetExcept////////////////
    public $sortField = 'no_urut';
    public $sortAsc = true;


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

            'isOpen',
            'tampilIsOpen',
            'isOpenMode'
        ]);
    }




    // open and close modal start////////////////
    private function openModal(): void
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenMode = 'insert';
    }
    private function openModalEdit(): void
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenMode = 'update';
    }

    private function openModalTampil(): void
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isOpenMode = 'tampil';
    }

    public function closeModal(): void
    {
        $this->resetInputFields();
    }
    // open and close modal end////////////////




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



    // is going to insert data////////////////
    public function create()
    {
        $this->openModal();
    }



    // insert record start////////////////
    public function store($id)
    {

        $customErrorMessages = [
            'table.no_urut.required' => 'No Urut tidak boleh kosong',
            'table.no_urut.numeric' => 'Data No Urut harus berupa Angka',
            'table.no_urut.max' => 'Data No Urut maximal 200',
            'table.no_urut.unique' => 'Data No Urut tidak boleh sama,  "' . $this->table['no_urut'] . '" sudah ada dalam Table',

            'table.nama.required' => 'Nama tidak boleh kosong'
        ];

        $rule = ($this->isOpenMode == 'insert') ? 'required|numeric|max:200|unique:calon_formatur,no_urut' :
            'required|numeric|max:200';
        // logic photo ->if photo true make foto false
        if ($this->photo) {
            $this->table["foto"] = "";
        };
        // ->if foto false make foto rule
        $rulePhoto = ($this->table["foto"]) ? '' : 'image|max:1024'; // 1MB Max
        // ->if foto false make foto name as foto else create foto rulse
        $filename = ($this->table["foto"]) ?  $this->table["foto"] : 'useravatars/' . time() . '.' . $this->photo->getClientOriginalExtension();


        $this->validate([
            'table.no_urut' => $rule,
            'table.nama' => 'required',
            'photo' =>  $rulePhoto
        ], $customErrorMessages);
        // image

        if ($this->isOpenMode == 'insert') {
            DB::table('calon_formatur')->insert([
                'no_urut' => $this->table["no_urut"],
                'nama' => $this->table["nama"],
                'foto' => $filename
            ]);
        } else if ($this->isOpenMode == 'update') {

            // dd(collect($this->photo));
            DB::table('calon_formatur')->where('no_urut', $id)
                ->update([
                    'no_urut' => $this->table["no_urut"],
                    'nama' => $this->table["nama"],
                    'foto' => $filename
                ]);
        }

        // uploadphoto if foto false
        ($this->table["foto"]) ?: $this->photo->storeAs('photos', $filename);

        $this->closeModal();
        $this->resetInputFields();
        $this->emit('toastr-success', "Data " . $this->table["nama"] . " berhasil disimpan.");
    }
    // insert record end////////////////



    // Find data from table start////////////////
    private function findData($value)
    {
        $findData = DB::table('calon_formatur')->where('no_urut', $value)->first();
        return $findData;
    }
    // Find data from table end////////////////



    // show edit record start////////////////
    public function edit($id)
    {
        $this->openModalEdit();

        $calonFOrmaatur = $this->findData($id);
        $this->table['no_urut'] = $id;
        $this->table['nama'] = isset($calonFOrmaatur->nama) ? $calonFOrmaatur->nama : 'xx';
        $this->table['foto'] = isset($calonFOrmaatur->foto) ? $calonFOrmaatur->foto : '';
    }
    // show edit record end////////////////



    // tampil record start////////////////
    public function tampil($id)
    {
        $this->openModalTampil();

        $calonFOrmaatur = $this->findData($id);
        $this->table['no_urut'] = $id;
        $this->table['nama'] = $calonFOrmaatur->nama;
    }
    // tampil record end////////////////



    // delete record start////////////////
    public function delete($id, $name)
    {


        DB::table('calon_formatur')->where('no_urut', $id)->delete();
        $this->emit('toastr-success', "Hapus data " . $name . " berhasil.");
    }
    // delete record end////////////////



    // select data start////////////////
    public function render()
    {
        return view(
            'livewire.calon-formatur.calon-formatur',
            [
                'calonFormatur' => DB::table('calon_formatur')->select('no_urut', 'nama', 'foto')
                    ->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('no_urut', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->limitPerPage),
                'myTitle' => 'Calon Formatur' . env('APP_FORMATUR', 'Sirus'),
                'mySnipt' => 'Tambah Data Calon Formatur',
                'myProgram' => 'Calon Formatur',
                'myLimitPerPages' => [5, 10, 15, 20, 100]
            ]
        );
    }
    // select data end////////////////
}
