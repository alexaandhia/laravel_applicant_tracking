<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Skill;
use App\Models\ApplicantSkill;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $skills = Skill::get();
        $query = Applicant::query();

        if (isset($request->department) && ($request->department != null)) {
            $query->where('department', $request->department);
        }
        if (isset($request->skill) && is_array($request->skill) && count($request->skill) > 0) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->whereIn('skills.id', $request->skill);
            });
        }

        $applicants = $query->paginate(3);
        return view('data', compact('applicants', 'skills'));
    }


    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $applicants = Applicant::with('skills')->paginate(3);
            return view('data_table', compact('applicants'))->render();
        }
    }

    public function search(Request $request)
    {
        dd($request->all());
        $department = $request->input('department');
        $skills = $request->input('skill');

        $query = Applicant::query();

        if ($department) {
            $query->where('department', $department);
        }

        if ($skills) {
            $skills = Skill::all();
            $skillIds = $skills->pluck('id')->toArray(); // Extract skill IDs

            $query->whereHas('skills', function ($q) use ($skillIds) {
                $q->whereIn('skills.id', $skillIds);
            });
        }

        $applicants = $query->with('skills')->paginate(5);

        return view('data', compact('applicants', 'skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $skills = Skill::get();
        return view('create', compact('skills'));
    }

    public function addSkill()
    {

        $skills = Skill::get();
        return view('skill', compact('skills'));
    }

    public function save(Request $request)
    {

        $request->validate([
            'skill' => 'required'
        ]);

        try {
            $existed = Skill::where('skill', $request->skill)->first();
            if ($existed) {
                return redirect()->back()->with('errorSkill', 'Skill Already Existed: ' . $request->skill);
            } else {
                Skill::create([
                    'skill' => $request->skill
                ]);
            }
            return redirect('/data')->with('success', 'New Skill Added');
        } catch (\Exception $error) {
            return redirect()->back()->with('errorSkill', $error->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'resume' => 'required|mimes:pdf', //pdf
            'skill' => 'required',
        ]);

        $pdf = $request->file('resume');
        $docs = rand() . '.' . $pdf->extension();
        $path = public_path('assets/resume/');
        $pdf->move($path, $docs);
        // yang resume jangan lupa diubah

        try {
            $applicant = Applicant::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'title' => $request->title,
                'description' => $request->description,
                'department' => $request->department,
                'experience' => $request->experience,
                'phone' => $request->phone,
                'email' => $request->email,
                'resume' => $docs,
                'employer' => $request->employer,
                'position' => $request->position,
                'applied' => $request->applied,
                'interview' => $request->interview,
                'interviewer' => $request->interviewer,
                'score' => $request->score,
                'status' => $request->status,
                'notes' => $request->notes,
            ]);
            $skills = $request->skill;
            foreach ($skills as $skillId) {
                // Cek apakah skill dengan ID tersebut ada di database
                $skill = Skill::find($skillId);
                if ($skill) {
                    // Jika ada, simpan ke tabel pivot "applicant_skills"
                    $applicant->skills()->attach($skillId);
                }
            }


            return redirect('/data')->with('success', 'Data Added');
        } catch (\Exception $error) {
            return redirect()->back()->with('errorAdd', $error->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant, $id)
    {
        $appplicant = Applicant::find($id);
        return view('index', compact('applicants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant, $id)
    {
        $applicant = Applicant::where('id', $id)->first();
        $skills = Skill::get();
        return view('edit', compact('applicant', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant, $id)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'resume' => 'required|mimes:pdf', //pdf
        ]);

        $pdf = $request->file('resume');
        $docs = rand() . '.' . $pdf->extension();
        $path = public_path('assets/resume/');
        $pdf->move($path, $docs);

        try {
            $applicant = Applicant::findOrFail($id);
            $applicant->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'title' => $request->title,
                'description' => $request->description,
                'department' => $request->department,
                'experience' => $request->experience,
                'phone' => $request->phone,
                'email' => $request->email,
                'resume' => $docs,
                'employer' => $request->employer,
                'position' => $request->position,
                'applied' => $request->applied,
                'interview' => $request->interview,
                'interviewer' => $request->interviewer,
                'score' => $request->score,
                'status' => $request->status,
                'notes' => $request->notes,
            ]);
            $skills = $request->skill;
            foreach ($skills as $skillId) {
                // Cek apakah skill dengan ID tersebut ada di database
                $skill = Skill::find($skillId);
                if ($skill) {
                    // Jika ada, simpan ke tabel pivot "applicant_skills"
                    $applicant->skills()->attach($skillId);
                }
            }
            return redirect('/data')->with('success', 'Data Edited');
        } catch (\Exception $error) {
            return redirect()->back()->with('errorEdit', $error->getMessage());
        }
    }

    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect('/data')->with('success', 'Skill Deleted');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Applicant::where('id', $id)->firstOrFail();
        unlink('assets/resume/' . $data['resume']);
        $data->delete();
        Applicant::where('id', $id)->delete();
        return redirect('/data')->with('success', 'Data Deleted');
    }
}
