<?php
namespace App\Http\Controllers; 

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Http\Requests\VendorRequest;

class VendorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(VendorRequest $request)
  {
      //dd($request);
      //$request->file; //('image')->getClientOriginalName();
      //dd( $request->file->getClientOriginalName());
    $userData = $request->validated();
   //dd($request->file->isValid());
    if ($request->file->isValid())
    { 
      $imgOriginName = $request->file->getClientOriginalName();
      $request->file->move(base_path('/react/public'), $imgOriginName); 
    } 
    
    Vendor::create([
        'vendor_name' => $userData['vendorName'],
        'vendor_account_no' => $userData['accountNo'],
        'vendor_passport' => $userData['passport'],
        'vendor_gst_no' => $userData['gstNo'],
        'vendor_file_name' => $imgOriginName,
        'vendor_file_size' => $userData['size']
      ]);
 
      return response(['message' => 'vendor added'], 200)
                      ->header('Content-Type', 'text/plain');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $comment = $request->input();
      if (auth()->id() == null)
      {
        return redirect('/')->with('status', 'You can not add a comment. Please sing up first!');
      }

      Comment::create([
        'user_id' => auth()->id(),
        'content_link' => $comment['content_link'],
        'comment' => $comment['comment']
      ]);

      return redirect('/');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Comment  $comment
   * @return \Illuminate\Http\Response
   */ 
  public function show()
  {
      //return base_path('286348561_576826423957910_7258625920069079691_n.jpg');
      //dd(9);  
        $vendors = Vendor::latest()->get();
        //$vendors = $vendors->take(12);
 
        return response($vendors, 200); 
  }
  
  public function getVendorById(Request $request)
  {
      //return base_path('286348561_576826423957910_7258625920069079691_n.jpg');
      //dd($request->input()['vendor_id']);  
      $vendor = Vendor::where([
        'vendor_id' => $request->input()['vendor_id']
      ])->get();
      //$vendors = $vendors->take(12);
   
       return response($vendor, 200); 
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function edit(Comment $comment)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Comment $comment)
  {
    $request = json_decode($request->input()['data']);

    foreach ($request as $key => $value)
    {
     if (!is_null($value))
     {
       $comment = $comment::where([
         'comment_id' => $key
       ])->update(['comment' => $value]);
     }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Comment  $comment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $comment)
  {
      //
  }
}
