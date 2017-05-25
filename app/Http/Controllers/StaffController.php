<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Borrower;
use App\borrower_item;
use App\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function main(){
    	$items = Item::paginate(10);
    	return view('staff.main', compact('items'));
    }

    public function staff_borrow($item_id){
    	$find_item = Item::find($item_id);
    	if(!$find_item){
    		abort(404);
    	}

    	return view('staff.borrow', compact('find_item'));
    }
    public function borrow_item(Request $request, $item_id){
    	$this->validate($request, [
    		'real_price' => 'required|max:18',
    		'lname' => 'required|max:50',
    		'quantity'=> 'required|max:4'
    	]);

    	$borrower = new Borrower;
    	$borrower->lname = $request['lname'];
//    	$borrower->fname = $request['fname'];
//    	$borrower->mname = $request['mname'];
    	$borrower->save();

    	$find_borrower = Borrower::find($borrower->id);
    	$borrower_item = new borrower_item;
    	$borrower_item->item_id = $item_id;
    	$borrower_item->quantity = $request['quantity'];
    	$borrower_item->real_price = $request['real_price'];
    	$borrower_item->status = 0;
    	$find_borrower->borrower_item()->save($borrower_item);

    	$item = Item::find($item_id);
    	$item->quantity = $item->quantity - $request['quantity'];
    	Item::where('id',$item_id)->update(['quantity'=> $item->quantity]);

    	return redirect()->route('staff')->with('borrow', 'You have sell item successfully');
    }

    public function view_borrowed_item($item_id){
    	$find_item = Item::find($item_id);
    	$borrowers = borrower_item::distinct('borrower_id')->where('item_id', $item_id)->where('status', 0)->get();
    	return view('staff.view_borrowed',compact('find_item', 'borrowers'));
    }
	public function update_quantity_item($item_id){
    	$find_item = Item::find($item_id);
//    	$borrowers = borrower_item::distinct('borrower_id')->where('item_id', $item_id)->where('status', 0)->get();
    	return view('staff.update_quantity_item',compact('find_item')); //, 'borrowers'));
    }
    public function staff_return($item_id, $borrowed_id){
    	$item = Item::find($item_id);
    	borrower_item::where('id',$borrowed_id)->where('status', 0)->update(['status'=> 1]);
    	$borrower_item = borrower_item::find($borrowed_id);
    	$quantity = $item->quantity + $borrower_item->quantity;
    	Item::where('id', $item_id)->update(['quantity'=> $quantity]);
    	return redirect()->back()->with('quantity', 'Item has been return successfully');
    }
    public function add_item(Request $request){
        $this->validate($request, [
            'name' => 'required|max:30',
            'quantity' => 'required|max:5',
			'price' => 'required|max:18',
        ]);

        $user = User::find(Auth::id());
        $item = new Item;
        $item->name = $request['name'];
        $item->quantity = $request['quantity'];
        $item->price = $request['price'];
        $user->item()->save($item);
        return redirect()->back()->with('item', 'You have successfully added new item');
    }
	public function action_update_quantity_item($item_id, Request $request){
        $this->validate($request, [
            'add_quantity' => 'required|max:5'
        ]);
		$itemFind = Item::find($item_id);
		$quantity = $itemFind->quantity + $request['add_quantity'];
		Item::where('id', $item_id)->update(['quantity'=> $quantity]);
		$items = Item::paginate(10);
		return view('staff.main', compact('items')) ->with('itemFind', 'You have successfully updated'.$itemFind->name.' by '.$quantity);
    }

    public function search(Request $request){
        $this->validate($request, [
            'search'=> 'required',
        ]);
        $items = Item::where('name','LIKE',$request['search'])->get();
        return view('staff.search', compact('items'));
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('index');
    }

}
