<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Adminlogs;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $data = [];
        $data['title'] = 'Added';
        $data['description'] = 'Category Name: '.$request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('flash', 'Category has been successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        $data = [];
        $data['title'] = 'Updated';
        $data['description'] = 'Category Name: '.$request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('flash', 'Category has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $data = [];
        $data['title'] = 'Deleted';
        $data['description'] = 'Category Name: '.$category['name'];
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('flash', 'Category has successfully deleted');
    }
}
