<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
      /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;

    public function data(){
        try{
            $data = Subject::all();
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
        return view('subject.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('subject.create');
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
            'name' => 'required'
        ], $messages);


        $subject = new Subject();
        $subject->name = $request->get('name');
        $subject->save();
        if ($subject) {
            //redirect dengan pesan sukses
            return redirect()->route('subject.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('subject.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $subject = Subject::findOrFail($id);
        return view('subject.edit', compact('subject'));
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
            'name' => 'required',
        ], $messages);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->get('name');
        $subject->save();
        if ($subject) {
            //redirect dengan pesan sukses
            return redirect()->route('subject.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('subject.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id)->delete();
        if ($subject) {
            return redirect()->route('subject.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('subject.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
