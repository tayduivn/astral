<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\{Show, EventType};

class CalendarController extends Controller
{
    public function index(Request $request) {
      $shows = Show::where('id', '!=', 1)
                   ->where('active', true)
                   ->orderBy('name', 'asc')
                   ->pluck('name', 'id');
                   
      $shows->prepend('No Show', 1);
      $eventTypes = EventType::where('id', '<>', 1)->orderBy('name', 'asc')->pluck('name', 'id');

      return view('admin.calendar.index', compact('shows'), compact('eventTypes'))->withRequest($request);
    }
    //
    public function events(Request $request) {
      $shows = Show::where('id', '!=', 1)->orderBy('name', 'asc')->pluck('name', 'id');
      $shows->prepend('No Show', 1);
      $eventTypes = EventType::where('id', '<>', 1)->orderBy('name', 'asc')->pluck('name', 'id');

      return view('admin.calendar.events', compact('shows'), compact('eventTypes'))->withRequest($request);
    }

    //
    public function sales(Request $request) {
      $shows = Show::where('id', '!=', 1)->orderBy('name', 'asc')->pluck('name', 'id');
      $shows->prepend('No Show', 1);
      $eventTypes = EventType::where('id', '<>', 1)->orderBy('name', 'asc')->pluck('name', 'id');

      return view('admin.calendar.sales', compact('shows'), compact('eventTypes'))->withRequest($request);
    }
}
