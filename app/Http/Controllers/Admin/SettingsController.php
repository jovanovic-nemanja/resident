<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Tabs;
use App\Fields;
use App\Groups;
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
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = DB::table('setting_tabs')
                            ->join('groups', 'setting_tabs.id', '=', 'groups.tabId')
                            ->select('setting_tabs.*', 'groups.id as GroupID', 'groups.*')
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
        return view('admin.settings.create');
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
            'group_title' => 'required',
            'arrayValue' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];
        $group_title = $request->group_title;

        $group = Groups::create([
            'title' => $group_title,
            'tabId' => 1,   //for test
            'sign_date_group' => $date,
        ]);
        $groupID = $group['id'];

        $arrayValue = json_decode($request->arrayValue);
        if($arrayValue) {
            foreach ($arrayValue as $arr) {
                
                $field = new Fields;

                $field->fieldName = $arr->fieldName;
                $field->group_id = $groupID;
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
        $settings = DB::table('setting_tabs')
                            ->join('groups', 'setting_tabs.id', '=', 'groups.tabId')
                            ->where('groups.id', $id)
                            ->select('setting_tabs.*', 'groups.*')
                            ->get();

        return view('admin.settings.edit', compact('settings'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Groups::where('id', $id)->first();
        $groupID = $group->id;

        $fields = Fields::where('group_id', $groupID)->get();
        if (@$fields) {
            foreach ($fields as $field) {
                $fieldtypes = FieldTypes::where('fieldID', $field->id)->delete();
            }
        }
        $fields = Fields::where('group_id', $groupID)->delete();
        $fields = Groups::where('id', $id)->delete();
        
        return redirect()->route('settings.index');
    }
}
