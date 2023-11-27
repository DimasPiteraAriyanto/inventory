<?php

namespace App\Http\Controllers;

use App\Models\DetailMasterValue;
use App\Models\MasterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Kyslik\ColumnSortable\Sortable;

class MasterValueController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $row = (int)request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $values = MasterValue::with('detailValues')
            ->filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

//        dd($values);

        return view('values.index', [
            'values' => $values,
        ]);
    }

    public function create()
    {
        return view('values.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $value = MasterValue::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['value_id' => $value->id]);
    }

    public function storeDetailMasterValue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'master_value_id' => 'required|exists:master_values,id',
            'names.*' => 'required|string|max:255',
            'descriptions.*' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $masterValueId = $request->input('master_value_id');
            $names = $request->input('names');
            $descriptions = $request->input('descriptions');

            // Create the DetailMasterValues
            for ($i = 1; $i < count($names); $i++) {
                DetailMasterValue::create([
                    'master_value_id' => $masterValueId,
                    'name' => $names[$i],
                    'description' => $descriptions[$i],
                ]);
            }

            return response()->json(['success' => 'Value Details have been created']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit ($idValues)
    {
        $value = MasterValue::find($idValues);
        $details = DetailMasterValue::where('master_value_id', '=', $idValues)->get();

        return view('values.edit', compact('value', 'details'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $masterValue = MasterValue::find($id);

            if (!$masterValue) {
                return response()->json(['error' => 'MasterValue not found'], 404);
            }

            $masterValue->name = $request->input('name');
            $masterValue->description = $request->input('description');
            $masterValue->save();

            return response()->json(['success' => 'MasterValue updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateDetailMasterValue(Request $request)
    {
        // Validate the request data
        $masterValueId = $request->input('master_value_id');
        $details = $request->input('details');

        // Update or create details based on the received data
        foreach ($details as $detail) {
            $detailId = $detail['id'];
            $detailName = $detail['name'];

            // Check if the detail already exists for this master value based on name
            $existingDetail = DetailMasterValue::where('master_value_id', $masterValueId)
                ->where('name', $detailName)
                ->first();

            if ($existingDetail) {
                // Update the existing detail
                $existingDetail = DetailMasterValue::find($detailId);

                if ($existingDetail) {
                    $existingDetail->name = $detail['name'];
                    $existingDetail->description = $detail['description'];
                    $existingDetail->save();
                }
            } else {
                // Create a new detail
                DetailMasterValue::create([
                    'master_value_id' => $masterValueId,
                    'name' => $detail['name'],
                    'description' => $detail['description'],
                ]);
            }
        }

        // Return a response indicating success or failure
        return response()->json(['message' => 'Details updated successfully']);

    }

    public function destroy($id)
    {
        // Find the master value
        $masterValue = MasterValue::find($id);

        if (!$masterValue) {
            return response()->json(['error' => 'Master value not found'], 404);
        }

        // Delete related detail_master_values
        $masterValue->detailValues()->delete();

        // Delete the master value
        $masterValue->delete();

        return Redirect::route('values.index')->with('success', 'Value has been deleted!');
    }

    public function destroyDetail($id)
    {
        // Find the master value
        $detailMasterValue = DetailMasterValue::find($id);

        if (!$detailMasterValue) {
            return response()->json(['error' => 'Master value not found'], 404);
        }

        // Delete the master value
        $detailMasterValue->delete();

        return Redirect::route('values.index')->with('success', 'Value has been deleted!');
    }
}
