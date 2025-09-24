<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluationFormPage extends Component
{
    use WithPagination;

    public $employee_id;
    public $week_start;
    public $notes;
    public $answers = []; // Array untuk menyimpan skor dan komentar per pertanyaan
    public $evaluationId;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'employee_id' => 'required|exists:users,id',
        'week_start' => 'required|date',
        'notes' => 'nullable|string',
        'answers.*.score' => 'required|integer|min:1|max:10',
        'answers.*.comment' => 'nullable|string',
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Inisialisasi answers dengan pertanyaan aktif
        $this->loadQuestions();
        // Set default week_start ke awal minggu ini
        $this->week_start = now()->startOfWeek()->format('Y-m-d');
    }

    public function loadQuestions()
    {
        $questions = EvaluationQuestion::where('is_active', true)->get();
        foreach ($questions as $question) {
            $this->answers[$question->id] = [
                'score' => null,
                'comment' => null,
                'question_snapshot' => $question->question,
            ];
        }
    }

    public function render()
    {
        $query = Evaluation::with(['employee', 'evaluator'])
            ->when($this->search, fn($q) => $q->whereHas('employee', fn($q2) => $q2->where('name', 'like', '%' . $this->search . '%')));

        $evaluations = $query->latest('created_at')->paginate(10);
        $employees = User::where('role', 'employee')->select('id', 'name')->get();
        $questions = EvaluationQuestion::where('is_active', true)->get();

        return view('livewire.evaluation-form-page', compact('evaluations', 'employees', 'questions'));
    }

    public function resetForm()
    {
        $this->reset(['employee_id', 'week_start', 'notes', 'answers', 'evaluationId', 'isEdit']);
        $this->loadQuestions();
        $this->week_start = now()->startOfWeek()->format('Y-m-d');
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        // Buat evaluasi baru
        $evaluation = Evaluation::create([
            'employee_id' => $this->employee_id,
            'evaluator_id' => Auth::user()->id,
            'week_start' => $this->week_start,
            'notes' => $this->notes,
            'total_score' => $this->calculateTotalScore(),
        ]);

        // Simpan jawaban per pertanyaan
        foreach ($this->answers as $questionId => $answer) {
            EvaluationAnswer::create([
                'evaluation_id' => $evaluation->id,
                'question_id' => $questionId,
                'question_snapshot' => $answer['question_snapshot'],
                'score' => $answer['score'],
                'comment' => $answer['comment'],
            ]);
        }

        session()->flash('success', 'Evaluasi berhasil dibuat.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $evaluation = Evaluation::with('answers')->findOrFail($id);
        $this->evaluationId = $evaluation->id;
        $this->employee_id = $evaluation->employee_id;
        $this->week_start = $evaluation->week_start->format('Y-m-d');
        $this->notes = $evaluation->notes;
        $this->isEdit = true;

        // Load jawaban yang sudah ada
        $this->answers = [];
        foreach ($evaluation->answers as $answer) {
            $this->answers[$answer->question_id] = [
                'score' => $answer->score,
                'comment' => $answer->comment,
                'question_snapshot' => $answer->question_snapshot,
            ];
        }

        // Pastikan semua pertanyaan aktif dimuat, jika ada pertanyaan baru
        $this->loadQuestions();
    }

    public function update()
    {
        $this->validate();

        $evaluation = Evaluation::findOrFail($this->evaluationId);
        $evaluation->update([
            'employee_id' => $this->employee_id,
            'evaluator_id' => Auth::user()->id,
            'week_start' => $this->week_start,
            'notes' => $this->notes,
            'total_score' => $this->calculateTotalScore(),
        ]);

        // Hapus jawaban lama
        EvaluationAnswer::where('evaluation_id', $evaluation->id)->delete();

        // Simpan jawaban baru
        foreach ($this->answers as $questionId => $answer) {
            EvaluationAnswer::create([
                'evaluation_id' => $evaluation->id,
                'question_id' => $questionId,
                'question_snapshot' => $answer['question_snapshot'],
                'score' => $answer['score'],
                'comment' => $answer['comment'],
            ]);
        }

        session()->flash('success', 'Evaluasi berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Evaluation::destroy($id);
        session()->flash('success', 'Evaluasi dihapus.');
    }

    protected function calculateTotalScore()
    {
        $scores = array_column($this->answers, 'score');
        $weights = EvaluationQuestion::whereIn('id', array_keys($this->answers))->pluck('weight', 'id')->toArray();
        $totalWeightedScore = 0;
        $totalWeight = 0;

        foreach ($scores as $questionId => $score) {
            if ($score !== null) {
                $weight = $weights[$questionId] ?? 1;
                $totalWeightedScore += $score * $weight;
                $totalWeight += $weight;
            }
        }

        return $totalWeight > 0 ? round($totalWeightedScore / $totalWeight, 2) : 0;
    }
}
