<?php

namespace App\Http\Livewire\Page;

use App\Models\Komentar as ModelsKomentar;
use Livewire\Component;

class Komentar extends Component
{
    public $komentar, $komentarField, $komentarReply;
    public $ArtikelId;
    public $replyStatus = false;

    public $getArtikelId, $getKomentarId;

    public function render()
    {
        $this->komentar = ModelsKomentar::where('status', true)->where('artikel_id', $this->ArtikelId)->with(['reply' => function ($query) {
            $query->where('status', true);
        }, 'user', 'reply.user'])->get();

        return view('livewire.page.komentar');
    }

    public function submitHandler()
    {

        if (!auth()->user()->id) {
            return redirect()->route('login');
        }
        $komentar = ModelsKomentar::create([
            'user_id' => auth()->user()->id,
            'artikel_id' => $this->ArtikelId,
            'parrent_id' => null,
            'komentar' => $this->komentarField,
            'status' => false
        ]);
        session()->flash('message', 'komentar berhasil, menunggu konfirmasi admin');
    }
    public function balas($item)
    {
        // dd($item['artikel_id']);
        $this->replyStatus = !$this->replyStatus;
        $this->getKomentarId = $item['id'];
        $this->getArtikelId = $item['artikel_id'];
    }

    public function reply()
    {
        $komentar = ModelsKomentar::create([
            'user_id' => auth()->user()->id,
            'artikel_id' => $this->getArtikelId,
            'komentar' => $this->komentarReply,
            'status' => false,
            'parent_id' => $this->getKomentarId,
        ]);
        session()->flash('message', 'komentar berhasil, menunggu konfirmasi admin');
    }
}