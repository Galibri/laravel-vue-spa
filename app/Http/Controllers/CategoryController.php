<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return response()->json($categories, 200);
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
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        $unique_slug = Str::slug($request->name);
        $unique_next = 2;
        while(Category::whereSlug($unique_slug)->first()) {
            $unique_slug = Str::slug($request->name) . '-' . $unique_next;
            $unique_next++;
        }

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $category = new Category;
            $category->name = $request->name;
            $category->slug = $unique_slug;
            $category->save();

            return response()->json(['result' => 'success', 'status' => 200, 'error' => array()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        $unique_slug = Str::slug($request->name);
        $unique_next = 2;
        while(Category::whereSlug($unique_slug)->first()) {
            if($category->name == $request->name) {
                $unique_slug = $category->slug;
                break;
            }
            $unique_slug = Str::slug($request->name) . '-' . $unique_next;
            $unique_next++;
        }

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $category->name = $request->name;
            $category->slug = $unique_slug;
            $category->save();

            return response()->json(['result' => 'success', 'category' => $category, 'status' => 200, 'error' => array()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()) {
            return response()->json(['result' => 'success', 'status' => 200, 'error' => array()]);
        } else {
            return response()->json(['result' => 'error', 'error' => 'failed']);
        }
    }
}
