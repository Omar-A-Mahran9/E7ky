<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAgendaRequest as ApiStoreAgendaRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Get all agendas for a specific event
    public function index()
    {
        $agendas = Agenda::get();

        return $this->success('Agendas fetched successfully', ['event' => $agendas]);

    }

    // Store a new agenda
    public function store(ApiStoreAgendaRequest $request)
    {
        // Fetch the validated data from the request
        $data = $request->validated();

        // Debug the validated data to make sure it is correct
        $agenda = Agenda::create($data);


        return $this->success('Agenda created successfully', ['event' => $agenda]);

    }

}
