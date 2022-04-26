<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $params = [
            'event' => Event::paginate(6)
        ];
        return view('event.index')->with($params);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
            'participant' => 'required',
            'date' => 'required',
            'note' => 'required|min:50',
            'image' => 'required|image',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => 'Validate Error!',
                'error' => implode('<br>', $validate->errors()->all())
            ]);
        }

        try {
            $event = new Event;
            $event->date = Carbon::parse($request->date ?? Carbon::now());
            $item = $request->file('image');
            if ($item) {
                $path = $item->storeAs(
                    'event/image',
                    'event-' . $event->date->format('dmY') . '-' . Str::random(6) . '.' . $item->extension(),
                );
                $event->image = $path;
            }
            $event->title = $request->title;
            $event->location = $request->location;
            $event->participant = $request->participant;
            $event->note = $request->note;
            $event->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Event Saved',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => 'Event Not Saved',
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function dashboard(Request $request)
    {
        $dateStart = Event::orderBy('date', 'asc')->first()->date;
        $dateEnd = Event::latest('date')->first()->date;

        if ($request->ajax()) {
            $dateStart = $request->get('dateStart') ? Carbon::parse($request->get('dateStart')) : Event::orderBy('date', 'asc')->first()->date;
            $dateEnd = $request->get('dateEnd') ? Carbon::parse($request->get('dateEnd')) : Event::latest('date')->first()->date;

            $start = $request->get('start') ?? 0;
            $search = $request->input('search.value');
            $length = $request->get('length') ?? 5;
            $draw = $request->get('draw');

            if ($search) {
                $data = Event::where('title', 'like', '%' . $search . '%')->orWhere('location', 'like', '%' . $search . '%')->orWhere('participant', 'like', '%' . $search . '%')->whereBetween('date', [$dateStart, $dateEnd])->skip($start)->limit($length)->get();
            } else {
                $data = Event::whereBetween('date', [$dateStart, $dateEnd])->skip($start)->limit($length)->get();
            }
            $params = [
                'draw' => $draw,
                'recordsTotal' => Event::count(),
                'recordsFiltered' => Event::count(),
                'data' => $data,
                'dateStart' => $dateStart,
                'date' => $dateEnd,
            ];

            return json_encode($params);
        }

        return view('dashboard.index')->with([
            'dateStart' => Carbon::parse($dateStart)->format('d/m/y'),
            'dateEnd' => Carbon::parse($dateEnd)->format('d/m/y'),
        ]);
    }
}
