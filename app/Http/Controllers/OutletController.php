<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Auth;
use App\Outlet;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\OutletsDataTable;
use App\User;

class OutletController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = array();
		$outlet = new Outlet;
		$data['outlets'] = $outlet->all();
		return view('outlet.index')->with($data);
	}

	/**    
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['page_title'] = 'Outlet';
		return view('outlet.new')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required'
		]);

		$outlet = new Outlet;

		$newCode = $this->getNewCode();

		$outlet->code = $newCode;
		$outlet->name = $request->name;
		$outlet->coordinates = $request->coordinates;
		$outlet->description = $request->description;
		$outlet->created_by = Auth::user()->id;

		$outlet->save();
		Session::flash('flash_message', 'Outlet successfully added!');
		return redirect('outlet/show/'.$outlet->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id)
	{
		$data['page_title'] = 'Outlet';

		$data['outlet'] = Outlet::where('id', '=', $id)->firstOrFail();

		return view('outlet.show')->with($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['page_title'] = 'Outlet';

		$data['outlet'] = Outlet::where('id', '=', $id)->firstOrFail();

		return view('outlet.show')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$this->validate($request, [
			'name' => 'required'
		]);

		$data['page_title'] = 'Outlet';

		$outlet = Outlet::find($request->id);
		$outlet->code = $request->code;
		$outlet->name = $request->name;
		$outlet->coordinates = $request->coordinates;
		$outlet->description = $request->description;
		$outlet->updated_by = Auth::user()->id;

		$outlet->save();
		Session::flash('flash_message', 'Outlet successfully updated!');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$outlet = Outlet::find($request->id);
		$name = $outlet->name;
		$outlet->delete();
		Session::flash('flash_message', 'Outlet successfully deleted! Outlet: '.$name);
		return redirect('outlet');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create_page($id)
	{
		$data['page_title'] = 'Create Page for Outlet: ' . $id;

		return view('outlet.page.create')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function new_page($id)
	{
		$data['page_title'] = 'Create Page for Outlet: ' . $id;
		$data['show_id'] = $id;
		return view('outlet.page.new')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_page($id)
	{
		$data['page_title'] = 'Show Page for Outlet: ' . $id;

		return view('outlet.page.show')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_page(Request $request)
	{
		$data['page_title'] = 'Outlet';
		return $request->editor1;
	}

	public function dataTableData(){
		$outlet = new Outlet;
		$outlets = $outlet->select('*');
		return Datatables::of($outlets)
			->addColumn('checkmark', function($data){
				return '<input type="checkbox" name="outlet_id" value='. $data->id .'>';
			})
			->addColumn('actions', function($data){
				return '<a type="button" class="btn btn-xs btn-info" href="'.url('outlet/show/'.$data->id).'">show</a> | <button class="btn btn-xs btn-default" onclick="alert(\'Add showing!!!\');"><span class="fa fa-plus"></span> showing</button> | <a type="button" class="btn btn-xs btn-default" href="'.url('outlet/page/new/'.$data->id).'"><span class="fa fa-plus"></span> page</a>';
			})
			->make(true);
	}

	public function getNewCode(){
		$codePrefix = 'O';
		$codeLength = 6;
		$lastCode = Outlet::orderby('ID', 'desc')->first();
		if(!isset($lastCode->code)){
			$lastCode = '';
		}else{
			$lastCode = $lastCode->code;
		}
		$newCode = getNewCode($lastCode, $codePrefix, $codeLength);
		return $newCode;
	}

}
