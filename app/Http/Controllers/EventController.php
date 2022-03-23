<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', [
            'list_unit' => Unit::list_unit(),
            'list_dkm' => Unit::list_dkm(),
            'unit_event_count' => Event::unit_event_list_count(),
            'dkm_event_count' => Event::dkm_event_list_count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        // dd($request);

        if (Auth::check()) {
            $newestevent = Event::orderBy('event_id', 'desc')->first();

            if ($request->tambah_event == 1) {

                $credentials = $request->validate([
                    'img.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                    'pdf' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
                ]);

                $img_public_path = 'storage/event-images/';

                $jum_gam = count($request->file('img'));

                if ($jum_gam !== 3) {
                    return redirect()->back()->with('danger', 'Pastikan 3 gambar terupload, dan berupa img !');
                }

                $image_names = array();
                // loop through images and save to /uploads directory
                foreach ($request->file('img') as $image) {
                    $name = md5(rand(1000, 10000));
                    // $ext = 'strtolower($image->getClientOriginalExtension())';
                    $ext = 'jpg';
                    $img_full_name = $name . '.' . $ext;
                    $img_url = $img_public_path . $img_full_name;
                    $image->move($img_public_path, $img_full_name);
                    $image_names[] = $img_url;
                }

                $event = Event::create([
                    'event_id' => $newestevent['event_id'] + 1,
                    'event_name' => $request->event_name,
                    'start_at' => $request->start_at,
                    'end_at' => $request->end_at,
                    'event_desc' => $request->event_desc,

                    // user_id dan unit_id nantinya akan disesuaikan dengan Auth()
                    'user_id' => auth()->id(),
                    'unit_id' => Auth::user()->unit_id,

                    'pdf' => $request->file('pdf')->store('event-pdfs'),
                    'image' =>  implode('|', $image_names),

                    'budget' => $request->budget,

                ]);
            }

            return redirect()->back()->with('success', 'Acara Berhasil Diregistrasi !');
        }
        // return redirect()->route('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($event)
    {
        //nama unit,desc unit, all event att
        // dd(count(Event::event_unit($event)));

        return view('unit', [
            'event' => Event::event_unit_user($event),
            'event_count' => count(Event::event_unit_user($event)),
            'event_empty' => Event::event_empty($event),
            'event_unit_upper_three' => Event::event_unit_upper_three($event),
            'list_unit' => Unit::list_unit(),
            'list_dkm' => Unit::list_dkm(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id)
    {

        $eventnya = Event::where('event_id', $event_id)->first();

        if ($request->ubah_event == 1) {
            // hapus pdf dan image lama, bila ada isi
            if ($eventnya->image !== null) {
                $kumpulan_gambar = explode("|", $eventnya->image);

                foreach ($kumpulan_gambar as $mg) {
                    File::delete(public_path($mg));
                }
            }

            if (is_null($eventnya->pdf) == false) {
                $evenpdf = $eventnya->pdf;
                File::delete(public_path('storage/' . $evenpdf));
            }

            // validate img n pdf
            $credentials = $request->validate([
                'imgmdl.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'pdf_mdl' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);

            $img_public_path = 'storage/event-images/';

            $jum_gam = count($request->file('imgmdl'));

            if ($jum_gam !== 3) {
                return redirect()->back()->with('danger', 'Pastikan 3 gambar terupload, dan berupa img !');
            }

            $image_names = array();
            // loop through images and save to /uploads directory
            foreach ($request->file('imgmdl') as $image) {
                $name = md5(rand(1000, 10000));
                // $ext = 'strtolower($image->getClientOriginalExtension())';
                $ext = 'jpg';
                $img_full_name = $name . '.' . $ext;
                $img_url = $img_public_path . $img_full_name;
                $image->move($img_public_path, $img_full_name);
                $image_names[] = $img_url;
            }
            // update data
            if ($request->edit_budget_mdl !== null) {
                $eventnya->update([

                    'event_name' => $request->edit_event_name_mdl,
                    'start_at' => $request->edit_start_at_mdl,
                    'end_at' => $request->edit_end_at_mdl,
                    'event_desc' => $request->edit_event_desc_mdl,

                    'user_id' => auth()->id(),
                    'unit_id' => Auth::user()->unit_id,

                    'pdf' => $request->file('pdf_mdl')->store('event-pdfs'),
                    'image' =>  implode('|', $image_names),
                    'budget' => $request->edit_budget_mdl,
                ]);
            } elseif ($request->edit_budget_mdl == null) {
                $eventnya->update([

                    'event_name' => $request->edit_event_name_mdl,
                    'start_at' => $request->edit_start_at_mdl,
                    'end_at' => $request->edit_end_at_mdl,
                    'event_desc' => $request->edit_event_desc_mdl,

                    'user_id' => auth()->id(),
                    'unit_id' => Auth::user()->unit_id,

                    'pdf' => $request->file('pdf_mdl')->store('event-pdfs'),
                    'image' =>  implode('|', $image_names),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Perubahan Detail Acara Tersimpan !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {
        if (preg_match("/a/", $event_id)) {
            return redirect()->back();
        } else {
            $eventnya = Event::where('event_id', $event_id)->first();

            // hapus pdf dan image lama, bila ada isi
            if ($eventnya->image !== null) {
                $kumpulan_gambar = explode("|", $eventnya->image);

                foreach ($kumpulan_gambar as $mg) {
                    File::delete(public_path($mg));
                }
            }

            if (is_null($eventnya->pdf) == false) {
                $evenpdf = $eventnya->pdf;
                File::delete(public_path('storage/' . $evenpdf));
            }

            DB::table('events')->where('event_id', $event_id)->delete();

            return redirect()->back()->with('danger', 'Event Berhasil Dihapus !');
        }
    }

    public function download($event_id)
    {
        $event = Event::where('event_id', $event_id)->firstOrFail();
        $pathToFile = public_path('storage/' . $event->pdf);
        return response()->download($pathToFile);
    }
}
