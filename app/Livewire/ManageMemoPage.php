<?php

namespace App\Livewire;

use App\Models\Memo;
use App\Services\OneSignalService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMemoPage extends Component
{
    use WithPagination;

    public $title;
    public $body;
    public $priority = 'normal';
    public $status = 'draft';
    public $memoId;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'title'    => 'required|string|max:255',
        'body'     => 'required|string',
        'priority' => 'required|in:low,normal,high',
        'status'   => 'required|in:draft,sent',
    ];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Memo::with('sender')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'));

        $memos = $query->latest('created_at')->paginate(10);

        return view('livewire.manage-memo-page', compact('memos'));
    }

    public function resetForm()
    {
        $this->reset(['title', 'body', 'priority', 'status', 'memoId', 'isEdit']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        $memo = Memo::create([
            'title'     => $this->title,
            'body'      => $this->body,
            'priority'  => $this->priority,
            'status'    => $this->status,
            'sender_id' => Auth::user()->id,
            'sent_at'   => $this->status === 'sent' ? now() : null,
        ]);

        // jika status = sent, trigger event / job untuk kirim FCM (implementasikan job terpisah)
        if ($memo->status === 'sent') {
            $signal = new OneSignalService();
            $signal->sendToAllSubscribed($memo->title, $memo->body);
        }

        session()->flash('success', 'Memo berhasil dibuat.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $memo = Memo::findOrFail($id);
        $this->memoId = $memo->id;
        $this->title = $memo->title;
        $this->body = $memo->body;
        $this->priority = $memo->priority;
        $this->status = $memo->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $memo = Memo::findOrFail($this->memoId);
        $memo->update([
            'title'    => $this->title,
            'body'     => $this->body,
            'priority' => $this->priority,
            'status'   => $this->status,
            'sent_at'  => $this->status === 'sent' && !$memo->sent_at ? now() : $memo->sent_at,
        ]);

        if ($memo->status === 'sent') {
            $signal = new OneSignalService();
            $signal->sendToAllSubscribed($memo->title, $memo->body);
        }

        session()->flash('success', 'Memo berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Memo::destroy($id);
        session()->flash('success', 'Memo dihapus.');
    }

    public function publish($id)
    {
        $memo = Memo::findOrFail($id);
        if ($memo->status !== 'sent') {
            $memo->update(['status' => 'sent', 'sent_at' => now()]);
            // dispatch send job
            // dispatch(new \App\Jobs\SendMemoNotification($memo));
            session()->flash('success', 'Memo berhasil dikirim (published).');
        }
    }
}
