<?php

namespace App\Livewire;

use App\Models\EvaluationQuestion;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationQuestionPage extends Component
{
    use WithPagination;

    public $question;
    public $weight = 1;
    public $is_active = true;
    public $questionId;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'question' => 'required|string|max:255',
        'weight' => 'required|integer|min:1|max:10',
        'is_active' => 'required|boolean',
    ];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = EvaluationQuestion::when($this->search, fn($q) => $q->where('question', 'like', '%' . $this->search . '%'));

        $questions = $query->latest('created_at')->paginate(10);

        return view('livewire.evaluation-question-page', compact('questions'));
    }

    public function resetForm()
    {
        $this->reset(['question', 'weight', 'is_active', 'questionId', 'isEdit']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        EvaluationQuestion::create([
            'question' => $this->question,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
        ]);

        session()->flash('success', 'Pertanyaan berhasil dibuat.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $question = EvaluationQuestion::findOrFail($id);
        $this->questionId = $question->id;
        $this->question = $question->question;
        $this->weight = $question->weight;
        $this->is_active = $question->is_active;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $question = EvaluationQuestion::findOrFail($this->questionId);
        $question->update([
            'question' => $this->question,
            'weight' => $this->weight,
            'is_active' => $this->is_active,
        ]);

        session()->flash('success', 'Pertanyaan berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        EvaluationQuestion::destroy($id);
        session()->flash('success', 'Pertanyaan dihapus.');
    }

    public function toggleActive($id)
    {
        $question = EvaluationQuestion::findOrFail($id);
        $question->update(['is_active' => !$question->is_active]);
        session()->flash('success', 'Status pertanyaan berhasil diubah.');
    }
}
