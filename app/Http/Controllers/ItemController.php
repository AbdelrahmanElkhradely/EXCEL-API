<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use App\Models\Items;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $excel;
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
        $this->excel=$excel;
    }
    /**
     * @SWG\Get(
     *   path="/api/Items",
     *   summary="Get all items",
     *   operationId="testing",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *      	apipass="abc"
     *      ),
     * )
     *
     */
    public function index()
    {
        return Items::all();
    }
    /**
     * @SWG\Post(
     *   path="/api/items",
     *   tags={"Admin"},
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="create items",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="password", type="string", example="abc123")),
     *      )
     * )
     *
     */


    public function store(Request $request)
    {
      $item=  Items::create($request->all());
      return $item;
    }

    /**
     * @SWG\Get(
     *   path="/api/Items",
     *   summary="Get all items",
     *   operationId="testing",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *      	apipass="abc"
     *      ),
     * )
     *
     */
    public function show($id)
    {
        //
        return Items::find($id);
    }
    /**
     *
     * 	@SWG\Put(
     * 		path="/update_user",
     * 		tags={"users"},
     *   security={
     *     {"passport": {}},
     *   },
     * 		summary="Update user entry",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="name", type="string", example="abcd"),
    @SWG\Property(property="email", type="string", example="abc@domain.com"),
    @SWG\Property(property="phone", type="string", example="+123123123")),
     *      )
     * 	)
     *
     */

    public function update(Request $request, $id)
    {
        //
        $item=Items::find($id);
        $item->update($request->all());
        return $item;
    }
    /**
     *
     * 	@SWG\Delete(
     * 		path="/delete_user",
     * 		tags={"users"},
     *   security={
     *     {"passport": {}},
     *   },
     * 		summary="Update user entry",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="parameter", type="string", example="abc123")),
     *      )
     * 	)
     *
     */

    public function destroy($id)
    {
        //
        return Items::destroy($id);
    }

    /**
     * @SWG\Post(
     *   path="/api/admin/update_password",
     *   tags={"Admin"},
     *   security={
     *     {"passport": {}},
     *   },
     *   summary="Update password",
     *   operationId="update password",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="Parameters",
     *          in="body",
     *			description="Update all parameters",
     *          required=true,
     *          type="string",
     *   		@SWG\Schema(@SWG\Property(property="userid", type="string", example="123"),
    @SWG\Property(property="password", type="string", example="abc123")),
     *      )
     * )
     *
     */
    public function export(){
        return $this->excel->download(new ItemsExport('fish') , 'items.csv');
    }


}
