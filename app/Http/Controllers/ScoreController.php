<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
      /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;

    public function data(Request $request){
        $student_id = $request->student_id ?? null;
        $subject_id = $request->subject_id ?? null;
        try{
            $data = Score::with('student','subject')
            ->when(
                $student_id != null,
                function ($q) use ($student_id) {
                    return $q->where('student_id', '=', $student_id);
                }
            )

            ->when(
                $subject_id != null,
                function ($q) use ($subject_id) {
                    return $q->where('subject_id', '=', $subject_id);
                }
            )

            ->get();
            return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
        } catch (Exception $e) {
            DB::commit();
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function index()
    {
        $subject = Subject::all();
        $student = Student::all();
        return view('score.index',compact('subject','student'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $subject = Subject::all();
        $student = Student::all();
        return view('score.create', compact('subject','student'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom Wajib diisi!',
        ];

        $this->validate($request, [
            'score' => 'required',
            'student_id' => 'required',
            'subject_id' => 'required',
        ], $messages);


        $score = new score();
        $score->student_id = $request->get('student_id');
        $score->subject_id = $request->get('subject_id');
        $score->score = $request->get('score');
        $score->save();
        if ($score) {
            //redirect dengan pesan sukses
            return redirect()->route('score.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('score.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     return view('v1::show');
    // }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $score = score::findOrFail($id);
        $subject = Subject::all();
        $student = Student::all();
        return view('score.edit', compact('score','subject','student'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom Wajib diisi!',
        ];

        $this->validate($request, [
            'score' => 'required',
            'student_id' => 'required',
            'subject_id' => 'required',
        ], $messages);

        $score = score::findOrFail($id);
        $score->student_id = $request->get('student_id');
        $score->subject_id = $request->get('subject_id');
        $score->score = $request->get('score');
        $score->save();
        if ($score) {
            //redirect dengan pesan sukses
            return redirect()->route('score.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('score.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $score = score::findOrFail($id)->delete();
        if ($score) {
            return redirect()->route('score.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('score.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
