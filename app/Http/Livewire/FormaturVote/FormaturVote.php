<?php

namespace App\Http\Livewire\FormaturVote;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FormaturVote extends Component
{

    //  table data////////////////
    public $table =
    [
        'no_urut' => "",
        'nama' => ""
    ];

    public $calonFormatur = [];
    public $calonFormaturTerpilih = [];
    public $maxVoteNo;



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
            'calonFormatur',
            'calonFormaturTerpilih',
            'maxVoteNo',

        ]);
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



    // Logic VoteFor Start////////////////
    public function voteFor($key, $noUrut, $nama): void
    {
        if (collect($this->calonFormaturTerpilih)->count() < 9) {
            $this->calonFormatur[$key]['vote_status'] = ($this->calonFormatur[$key]['vote_status']) == 0 ? 1 : 0;
            $this->calonFormatur[$key]['vote_no'] = $this->maxVoteNo++;
            $this->rendercalonFormaturTerpilih();

            ($this->calonFormatur[$key]['vote_status'] == 1)
                ? $this->emit('toastr-success', "Vote untuk " . $noUrut . $nama .  " berhasil disimpan.")
                : $this->emit('toastr-error', "Vote untuk " . $noUrut . $nama .   " berhasil dihapus.");
        } else {
            if ($this->calonFormatur[$key]['vote_status'] == 1) {
                $this->calonFormatur[$key]['vote_status'] = 0;
                $this->rendercalonFormaturTerpilih();
                $this->emit('toastr-error', "Vote untuk " . $noUrut . $nama .   " berhasil dihapus.");
            } else {
                $this->emit('toastr-error', "Vote untuk calon Formatur tidak boleh lebih dari 9 orang.");
            }
        }
    }

    private function rendercalonFormatur()
    {
        if (empty($this->calonFormatur)) {
            $calonFormatur = DB::table('calon_formatur')->select('no_urut', 'nama')
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->get();

            $this->calonFormatur = json_decode(
                $calonFormatur->map(function ($calonFormatur) {
                    $calonFormatur->vote_status = 0;
                    $calonFormatur->vote_no = 0;
                    return $calonFormatur;
                }),
                true
            );
        }

        if (empty($this->maxVoteNo)) {
            $this->maxVoteNo = DB::table('votemu')->max('vote_no') + 1;
        }
    }

    private function rendercalonFormaturTerpilih(): void
    {
        $this->calonFormaturTerpilih = collect($this->calonFormatur)->where('vote_status', 1);
    }

    public function store()
    {
        if (collect($this->calonFormaturTerpilih)->count() != 9) {

            $this->emit('toastr-error', "Anda tidak bisa menyimpan Vote untuk calon Formatur sebelum memilih 9 orang.");
        } else {
            // ////////////////Remove nama From  collection//////////////
            $selected = [];
            foreach (collect($this->calonFormaturTerpilih) as  $item) {
                $selected[] = json_decode(collect($item)->forget('nama'), true);
            }
            $this->calonFormaturTerpilih = $selected;
            // ////////////////Remove nama From  collection//////////////

            DB::table('votemu')->insert($this->calonFormaturTerpilih);
            $this->emit('toastr-success', "Vote untuk calon Formatur berhasil disimpan.");
            $this->resetInputFields();
        }
    }





    public function render()
    {
        $this->rendercalonFormatur();

        return view(
            'livewire.formatur-vote.formatur-vote',
            [

                'myTitle' => 'Calon Formatur PDNA Tulungagung',
                'mySnipt' => 'Vote Calon Formatur',
                'myProgram' => 'Calon Formatur',
                'myLimitPerPages' => [5, 10, 15, 20, 100]
            ]
        );
    }
    // select data end////////////////
}
