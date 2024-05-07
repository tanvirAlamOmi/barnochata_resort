<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Package\PackageRoom;
use App\Models\DataContent\Addons;
use Cart;

class CartController extends Controller
{
    public function filterCartItem($cartItems, $type, $itemId) {
        foreach ($cartItems as $cartItem) {
            if($cartItem->options->type == $type && $cartItem->id == intval($itemId)){
                return $cartItem;
                break;
            }
        }
        return false;
    }

    public function add_to_cart(Request $request)
    {
         // Cart::destroy();
        if($request->name == 'room')
        {
            $room = Room::find($request->roomId);

            Cart::add([
                'id' => $room->id,
                'name' => $room->title,
                'qty' => 1,
                'price' => $room->price,
                'options' => [
                    'extra_person_per_adult' => $room->extra_person_per_adult,
                    'extra_person_per_child' =>  $room->extra_person_per_child,
                    'package' => '',
                    'type' => 'room',
                ]
            ]);
        }

        if($request->name == 'package')
        {
            $get_room_package = PackageRoom::with(['package'])->where('room_id',$request->roomId)->where('package_id',$request->packageId)->first();
            
            $room_package = [
                'id' => $get_room_package->package_id,
                'title' => $get_room_package->package->title,
                'default_guest' => $get_room_package->default_guest,
                'price' => $get_room_package->price,
                'extra_person_per_adult' => $get_room_package->extra_person_per_adult,
                'extra_person_per_child' =>  $get_room_package->extra_person_per_child,
            ];

            $cartItem = $this->filterCartItem(Cart::content(), 'room', $request->roomId);

            Cart::update($cartItem->rowId, ['options' => [
                'package' => $room_package
            ]]);
        }

        if($request->name == 'addons')
        {
            $addons = Addons::where('slug',$request->addonSlug)->first();

            Cart::add([
                'id' => $addons->id,
                'name' => $addons->title,
                'qty' => $request->addonCounter,
                'price' => $addons->charge,
                'options' => [
                    'type' => 'addons',
                ]
            ]);
        }

        return Cart::content();

    }

    public function update_cart_addons(Request $request)
    {
        $addons = Addons::where('slug',$request->addonSlug)->first();
        $cartItem = $this->filterCartItem(Cart::content(), 'addons', $addons->id);
        Cart::update($cartItem->rowId, ['qty' => $request->addonCounter]);


        return Cart::content();
    }

    public function remove_from_cart(Request $request)
    {
        if($request->name == 'room')
        {
            $cartItem = $this->filterCartItem(Cart::content(), 'room', intval($request->roomId));
            Cart::remove($cartItem->rowId);
        }

        if($request->name == 'package')
        {
            $cartItem = $this->filterCartItem(Cart::content(), 'room', $request->roomId);

            Cart::update($cartItem->rowId, ['options' => [
                'package' => null
            ]]);
        }

        if($request->name == 'addons')
        {
            $addons = Addons::where('slug',$request->addonSlug)->first();

            $cartItem = $this->filterCartItem(Cart::content(), 'addons', intval($addons->id));
            Cart::remove($cartItem->rowId);
        }

        return Cart::content();
    }
}
