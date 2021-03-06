<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RecordInterface;
class RecordController extends Controller
{

    protected $recordRepository;

    public function __construct(RecordInterface $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }
    
    public function index()
    {
        $records = Record::all();
        return view('records.index', compact('records'));
    }


    public function create()
    {
        return view('records.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'medida' => 'required',
            'ayuno' => 'required'
        ]);
        $this->recordRepository->store($request);

        return redirect('/home');
    }


    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }


}
