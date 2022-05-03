<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartHasProducts;
use App\Models\DeliverAreas;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\vat;
use App\Models\WebUser;
use App\Models\WebUserDeliveryDetails;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $collapse = 1;
        return view('/back_end/dashboard', compact('collapse'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }

    public function getAllProductForFrontEnd()
    {
        $products = (new Products)->getAllProducts();
        return view('/front_end/product_page', compact('products'));
    }

    public function getFeaturedProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        return (new Products)->getFeaturedProductsByCategory($request->category_id);

    }

    public function getProductForFrontEnd($category_id)
    {

        $products = (new Products)->getProductsByCategory($category_id);
        return view('/front_end/product_page', compact('products'));
    }

    public function productQuickView(Request $request)
    {
        $product = (new Products)->getProductById($request->id);
        return $product;
    }

    public function sessionRecords()
    {
        return Session::get('cartProducts', array());
    }

    public function addProductToCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'qty' => 'required|numeric|min:0.1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $records = $this->sessionRecords();
        $isNew = true;

        foreach ($records as $key => $product) {
            if ($product[0] == $request->id) {
                $records[$key][1] = $request->qty;
                $isNew = false;
                break;
            }
        }

        if ($isNew) {
            $records[] = [
                $request->id,
                $request->qty,
            ];
        }

        Session::put('cartProducts', $records);

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'des' => 'Successfully Added Product to GRN',
            'refresh_status' => 2,
            'fieild_reset_status' => 2,
        ]);
    }

    public function cartView()
    {
        if (Session::has('cartProducts')) {

            $records = $this->sessionRecords();
            $tableData = [];
            $total = 0;

            if (count($records) == 0) {
                return [env('CURRANCY') . ' ' . number_format($total, 2), $tableData];
            }

            foreach ($records as $key => $product) {

                $products = (new Products)->getProductById($product[0]);

                $tableData[] = [
                    ++$key,
                    Str::limit(($products->lang1_name), 20, '...'),
                    env('CURRANCY') . ' ' . number_format($products->default_price, 2),
                    $product[1],
                    number_format($products->default_price, 2),
                    $products['getProductImage'][0]['getMedia']['name'],
                ];

                $total += $product[1] * $products->default_price;
            }

            $tot = env('CURRANCY') . ' ' . number_format($total, 2);
            return [$tot, $tableData];
        } else {
            return 2;
        }
    }

    public function removeProductFromCart(Request $request)
    {
        $index = $request->index;
        $records = $this->sessionRecords();
        array_splice($records, $index, 1);

        if (count($records) > 0) {
            Session::put('cartProducts', $records);
            return 1;
        } else {
            Session::forget('cartProducts');
            return 2;
        }
    }

    public function checkCartAvailibility(Request $request)
    {

        $records = $this->sessionRecords();

        if (Session::has('cartProducts') || count($records) > 0) {
            return response()->json([
                'code' => 1,
                'type' => 'success',
                'des' => 'Cart Available',
                'refresh_status' => 2,
                'fieild_reset_status' => 2,
            ]);
        } else {
            return response()->json([
                'code' => 2,
                'type' => 'error',
                'des' => 'Please Add Item to Cart Before Checkout',
                'refresh_status' => 2,
                'fieild_reset_status' => 2,
            ]);
        }
    }

    public function getBillingSummary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $itemTotal = 0;
        $delivery_cost = DeliverAreas::find($request->city_id)->deliver_amount;
        $records = $this->sessionRecords();

        foreach ($records as $key => $product) {
            $products = (new Products)->getProductById($product[0]);
            $itemTotal += $product[1] * $products->default_price;
        }

        return [env('CURRANCY') . ' ' . number_format($itemTotal, 2), env('CURRANCY') . ' ' . number_format($delivery_cost, 2), env('CURRANCY') . ' ' . number_format(($itemTotal + $delivery_cost), 2)];
    }

    public function saveCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
            'email' => 'required',
            'city_id' => 'required|numeric|min:0',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $checkUser = false;
        $definedUser = null;
        $definedUserDeliverDetails = null;

        $user = (new WebUser)->getUniqueUser($request->mobile_number, $request->email, $request->fname);
        (empty($user) ? $checkUser = true : $checkUser = false);

        if ($checkUser) {

            $webUserData = [
                'code' => 'U/' . date('smy') . '/' . str_pad((new WebUser)->getWebUserCount() + 1, 3, '0', STR_PAD_LEFT),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'mobile_number' => $request->mobile_number,
                'whatsapp_number' => $request->mobile_number,
                'email' => $request->email,
                'web_user_type' => 2,
                'status' => 1
            ];

            $new_user = (new WebUser)->add($webUserData);

            $webUserDeliveryData = [
                'web_user_id' => $new_user->id,
                'deliver_area_id' => $request->city_id,
                'street_address' => $request->address,
                'status' => 1,
            ];

            $new_user_delivery_details = (new WebUserDeliveryDetails)->add($webUserDeliveryData);

            $definedUser = $new_user;
            $definedUserDeliverDetails = $new_user_delivery_details;
        } else {

            $definedUser = $user;
            $deliverRecords = (new WebUserDeliveryDetails)->getUniqueDeliveryDetails($user->id);
            $deliverRecordCheck = null;

            foreach ($deliverRecords as $key => $deliverRecord) {
                if (strtolower($deliverRecord->street_address) == strtolower($request->address)) {
                    $deliverRecordCheck = $deliverRecord;
                    break;
                }
            }

            $definedUserDeliverDetails = $deliverRecordCheck;

            if ($deliverRecordCheck == null) {
                $webUserDeliveryData = [
                    'web_user_id' => $user->id,
                    'deliver_area_id' => $request->city_id,
                    'street_address' => $request->address,
                    'status' => 1,
                ];
                $new_user_delivery_details = (new WebUserDeliveryDetails)->add($webUserDeliveryData);
                $definedUserDeliverDetails = $new_user_delivery_details;
            }
        }

        if ($definedUser != null || $definedUserDeliverDetails != null) {

            $smsUserNumber = $definedUser->mobile_number;
            $smsText = 'Thank you for shopping with City Market. Please give some time to confirm your order.';
            $response = Http::get('https://smspanel.lk/api/sms/send?key=drjeuAS567IxPyE3&dst=94' . $smsUserNumber . '&msg=' . $smsText . '&from=Richmo SMS');

            if (!$response['statusCode'] == 100) {
                return response()->json([
                    'code' => 2,
                    'type' => 'error',
                    'des' => 'Invalid Phone Number, Please Try Again',
                    'refresh_status' => 2,
                    'fieild_reset_status' => 2,
                ]);
            }

            // CART SAVE PROCESS
            error_log('CART SAVE PROCESS BEGUN ====================================================');

            $itemTotal = 0;
            $records = $this->sessionRecords();

            foreach ($records as $key => $product) {
                $products = (new Products)->getProductById($product[0]);
                $itemTotal += $product[1] * $products->default_price;
            }

            $cartData = [
                'web_user_id' => $definedUser->id,
                'total' => $itemTotal,
                'status' => 1,
            ];

            $cart = (new Cart)->add($cartData);

            foreach ($records as $key => $product) {
                $products = (new Products)->getProductById($product[0]);

                $cartHasProductData = [
                    'cart_id' => $cart->id,
                    'product_id' => $products->id,
                    'shp_id' => null,
                    'unit_price' => $products->default_price,
                    'qty' => $product[1],
                    'net_total' => $product[1] * $products->default_price,
                    'discount' => 0,
                    'sub_total' => $product[1] * $products->default_price,
                    'status' => 1
                ];

                (new CartHasProducts)->add($cartHasProductData);
            }

            $orderData = [
                'order_code' => 'OD/' . date('my') . '/' . str_pad((new Order)->getOrderCount() + 1, 3, '0', STR_PAD_LEFT),
                'cart_id' => $cart->id,
                'web_user_id' => $definedUser->id,
                'web_user_delivery_details_id' => $definedUserDeliverDetails->id,
                'order_type_id' => 2,
                'promotion_id' => 0,
                'vat_id' => 1,
                'net_total' => $itemTotal,
                'discount' => 0,
                'sub_total' => $itemTotal,
                'expected_deliver_date' => null,
                'deliver_charges' => DeliverAreas::find($definedUserDeliverDetails->deliver_area_id)->deliver_amount,
                'status' => 1,
            ];

            (new Order)->add($orderData);

            Session::forget('cartProducts');

            return response()->json([
                'code' => 1,
                'type' => 'success',
                'des' => 'Successfully Placed Order',
                'refresh_status' => 2,
                'fieild_reset_status' => 2,
            ]);
        } else {
            return response()->json([
                'code' => 1,
                'type' => 'error',
                'des' => 'Unable to Insert User',
                'refresh_status' => 2,
                'fieild_reset_status' => 2,
            ]);
        }
    }
}
