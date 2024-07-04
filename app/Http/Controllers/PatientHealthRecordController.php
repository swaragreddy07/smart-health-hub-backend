<?php

namespace App\Http\Controllers;

use App\Models\PatientHealthRecord;
use Illuminate\Http\Request;

class PatientHealthRecordController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        if (!$userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }

        $records = PatientHealthRecord::where('user_id', $userId)->get();

        return response()->json(['records' => $records], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // Add validation for other fields as needed
        ]);

        $record = PatientHealthRecord::create($request->all());

        return response()->json(['record' => $record], 201);
    }

    public function update(Request $request, $id)
    {
        $record = PatientHealthRecord::findOrFail($id);

        $record->update($request->all());

        return response()->json(['record' => $record], 200);
    }

    public function destroy($id)
    {
        $record = PatientHealthRecord::findOrFail($id);

        $record->delete();

        return response()->json(['message' => 'Record deleted'], 200);
    }
}
