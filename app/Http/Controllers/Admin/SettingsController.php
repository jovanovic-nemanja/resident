<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Tabs;
use App\Fields;
use App\RoleUser;
use App\FieldTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'manager']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinic_id = auth()->id();
        $settings = DB::table('setting_tabs')
                            ->join('fields', 'setting_tabs.id', '=', 'fields.tab_id')
                            ->where('fields.clinic_id', $clinic_id)
                            ->select('setting_tabs.*', 'fields.id as FieldID', 'fields.*')
                            ->get();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting_tabs = Tabs::all();

        return view('admin.settings.create', compact('setting_tabs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage via Ajax.
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tabsID' => 'required',
            'arrayValue' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $arrayValue = json_decode($request->arrayValue);
        if($arrayValue) {
            foreach ($arrayValue as $arr) {
                
                $field = new Fields;

                $field->fieldName = $arr->fieldName;
                $field->tab_id = $request->tabsID;
                $field->clinic_id = $clinic_id;
                $field->sign_date_field = $date;
                $field->save();
                
                $fieldID = $field->id;

                foreach ($arr->fieldValue as $fv) {
                    $fieldtypes = new FieldTypes;

                    $fieldtypes->typeName = $fv;
                    $fieldtypes->fieldID = $fieldID;
                    $fieldtypes->sign_date_field_type = $date;
                    $fieldtypes->save();
                }
            }
        }

        $result = route('settings.index');
        
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting_tabs = Tabs::all();
        $result = Fields::where('id', $id)->first();
        $fieldtypes = FieldTypes::where('fieldID', $id)->get();

        return view('admin.settings.edit', compact('setting_tabs', 'result', 'fieldtypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'tab_id' => 'required',
            'fieldName' => 'required',
            'fieldValue' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];

        $field = Fields::where('id', $id)->first();
        $field->fieldName = $request->fieldName;
        $field->tab_id = $request->tab_id;
        $field->update();

        $types = FieldTypes::where('fieldID', $id)->delete();

        foreach ($request->fieldValue as $fv) {
            $fieldtypes = new FieldTypes;

            $fieldtypes->typeName = $fv;
            $fieldtypes->fieldID = $id;
            $fieldtypes->sign_date_field_type = $date;
            $fieldtypes->save();
        }

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fieldtypes = FieldTypes::where('fieldID', $id)->delete();
        $fields = Fields::where('id', $id)->delete();
        
        return redirect()->route('settings.index');
    }
}
