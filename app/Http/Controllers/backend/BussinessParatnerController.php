<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\InternalUser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;
use App\Models\backend\BussinessPartnerMaster;
use App\Models\backend\BussinessMasterType;
use App\Models\backend\BussinessPartnerOrganizationType;
use App\Models\backend\TermPayment;
use App\Models\backend\BussinessPartnerAddress;
use App\Models\backend\BussinessPartnerContactDetails;
use App\Models\backend\BussinessPartnerBankingDetails;

class BussinessParatnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $details = BussinessPartnerMaster::all();

        return view('backend.bussinesspartner.index', compact('details'));
    }

    // //create new user
    public function create()
    {
        $bussinesstype = BussinessMasterType::all();
        $bpOrgType = BussinessPartnerOrganizationType::all();
        $termPayment = TermPayment::all();


        return view('backend.bussinesspartner.create', compact('bussinesstype', 'bpOrgType', 'termPayment'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'business_partner_type' => 'required',
            'bp_code' => 'required',
            'bp_name' => 'required|unique:business_partner_master,bp_name',
            'bp_organisation_type' => 'required',
            'bp_category' => 'required',
            'bp_group' => 'required',
            'sales_manager' => 'required',
            'sales_officer' => 'required',
            'salesman' => 'required',
            'payment_terms_id' => 'required',
            'credit_limit' => 'required',
            'gst_details' => 'required',
        ]);
        $data = $request->all();
        $bussiness = new BussinessPartnerMaster;
        $bussiness->fill($request->all());
        if ($bussiness->save()) {
            return redirect('/admin/bussinesspartner/create')->with('success', 'New Bussiness Partner Added');
            //$bid = $bussiness->business_partner_id;
            //$uid = ['bussiness_partner_id'=>$bid];
            //$full_data = array_merge($uid,$data);
        }
        //  if($bid !=""){
        //      $address = new BussinessPartnerAddress;

        //  $address_data =
        //  $address->fill($full_data);
        // $address->save();

        // if($bid !=""){
        //     $contact = new BussinessPartnerContactDetails;
        //     $contact->fill($full_data);
        //    $contact->save();
        // }

        // if($bid !=""){
        //     $banking = new BussinessPartnerBankingDetails;
        //     $banking->fill($full_data);
        //     $banking->save();

        // }


        //}


    }


    public function delete($id)
    {
        $data = BussinessPartnerMaster::where('business_partner_id', $id)->get();
        if (count($data) > 0) {
            if (BussinessPartnerMaster::where('business_partner_id', $id)->delete()) {
                return redirect('/admin/bussinesspartner')->with('success', 'Partner Has Been Deleted');
            }
        }
    }

    //edit details
    public function edit($id)
    {
        $bussinesstype = BussinessMasterType::all(['bussiness_master_type_id', 'bussiness_master_type']);
        $bpOrgType = BussinessPartnerOrganizationType::all();
        $termPayment = TermPayment::all();
        $bussinesspartner = BussinessPartnerMaster::where('business_partner_id', $id)->with('paymentterms')->first();

        return view('backend.bussinesspartner.edit', compact('bussinesspartner', 'bussinesstype', 'bpOrgType', 'termPayment'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'business_partner_id' => 'required',
            'business_partner_type' => 'required',
            'bp_code' => 'required',
            'bp_name' => 'required',
            'bp_organisation_type' => 'required',
            'bp_category' => 'required',
            'bp_group' => 'required',
            'sales_manager' => 'required',
            'sales_officer' => 'required',
            'salesman' => 'required',
            'payment_terms_id' => 'required',
            'credit_limit' => 'required',
            'gst_details' => 'required',
        ]);

        $bussiness = BussinessPartnerMaster::where('business_partner_id', $request->business_partner_id)->first();
        $bussiness->fill($request->all());
        if ($bussiness->save()) {
            return redirect('/admin/bussinesspartner')->with('success', 'Partner Has Been Updated');
        }
    }



    public function address($id)
    {
        $address = BussinessPartnerAddress::where('bussiness_partner_id', $id)->get();
        return view('backend.bussinesspartner.address', compact('address', 'id'));
    }

    //show new address form
    public function addaddress($id)
    {
        return view('backend.bussinesspartner.add_address', compact('id'));
    }

    public function storeaddress(Request $request)
    {
        $request->validate([
            'address_type' => 'required',
            'building_no_name' => 'required',
            'street_name' => 'required',
            'landmark' => 'required',
            'city' => 'required',
            'pin_code' => 'required|digits:6|min:6|max:6',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        //check bp_address id set or not
        if ($request->has('bp_address_id')) {
            //update code
            $address = BussinessPartnerAddress::where('bp_address_id', $request->bp_address_id)->first();
            $address->fill($request->all());
            if ($address->save()) {
                return redirect()->route('admin.bussinesspartner.address', ['id' => $address->bussiness_partner_id])->with('success', 'Address Has Been updated');
                // return redirect('admin/bussinesspartner/address/'.$id)->with('success', 'New Address Has Been Added');
            } else {
                return redirect()->route('admin.bussinesspartner.address', ['id' => $address->bussiness_partner_id])->with('error', 'Failed to Rupdate Address');
            }
        } else {
            //Insert Code
            $address = new BussinessPartnerAddress;
            $address->fill($request->all());
            $id = $request->bussiness_partner_id;
            if ($address->save()) {
                return redirect()->route('admin.bussinesspartner.address', ['id' => $id])->with('success', 'New Address Has Been Added');
                // return redirect('admin/bussinesspartner/address/'.$id)->with('success', 'New Address Has Been Added');
            } else {
                return redirect()->route('admin.bussinesspartner.address', ['id' => $id])->with('error', 'Failed to Register Address');
            }
        }
    }

    public function editaddress($addressid)
    {
        $address = BussinessPartnerAddress::where('bp_address_id', $addressid)->first();
        return view('backend.bussinesspartner.updateaddress', compact('address'));
    }

    //function for delete address
    public function deleteaddress($id){
        $address = BussinessPartnerAddress::where('bp_address_id', $id)->first();

        if(count($address->toArray()) > 0){
            $addresddata = BussinessPartnerAddress::where('bp_address_id', $id)->delete();
            return redirect()->route('admin.bussinesspartner.address', ['id' => $address->bussiness_partner_id])->with('error', 'Failed to Register Address');
        }
    }

    public function contactdetails($id)
    {
        $contact = BussinessPartnerContactDetails::where('bussiness_partner_id', $id)->get();
        return view('backend.bussinesspartner.contact', compact('contact','id'));
    }

    public function createcontact($id){
return view('backend.bussinesspartner.add_contact', compact('id'));
    }

    public function storecontact(Request $request)
    {

        $request->validate([
            'type' =>'required',
            'email_id' =>'required|email',
            'mobile_no' =>'required|digits:10|min:10',
        ]);


        if($request->has('contact_details_id') && $request->contact_details_id !=""){
            //update the data
            $contact = BussinessPartnerContactDetails::where('contact_details_id' , $request->contact_details_id)->first();
            $contact->fill($request->all());
            if($contact->save()){
                return redirect()->route('admin.bussinesspartner.contact', ['id' => $contact->bussiness_partner_id])->with('success', 'Contact Has Been Updates');
            }else{
                return redirect()->route('admin.bussinesspartner.contact', ['id' => $contact->bussiness_partner_id])->with('error', 'Failed to Update Contact');
            }

        }else{
            //inset the data
            $contact = new BussinessPartnerContactDetails;
        $contact->fill($request->all());
        if($contact->save() ){
            return redirect()->route('admin.bussinesspartner.contact', ['id' => $request->bussiness_partner_id])->with('success', 'Contact Has Been Added');
        }else{
            return redirect()->route('admin.bussinesspartner.contact', ['id' => $request->bussiness_partner_id])->with('error', 'Unable to add contact details');
        }
        }


    }


    public function editcontact($id){
    $contact = BussinessPartnerContactDetails::where('contact_details_id' , $id)->first();
    return view('backend.bussinesspartner.update_contact', compact('contact','id'));
    }

    //delete contact
    public function deletecontact($id){
        $contact = BussinessPartnerContactDetails::where('contact_details_id' , $id)->first();
        if(isset($contact) && count($contact->toArray()) > 0){
            $deleted = BussinessPartnerContactDetails::where('contact_details_id' , $id)->delete();
            if($deleted){
                return redirect()->route('admin.bussinesspartner.contact', ['id' => $contact->bussiness_partner_id])->with('success', 'Address Has Been Removed');
            }else{
                return redirect()->route('admin.bussinesspartner.contact', ['id' => $contact->bussiness_partner_id])->with('error', 'Unable to remove Address');
            }
        }

    }


//banking details
public function banking($id){
    // $bankdetails = BussinessPartnerBankingDetails::where('bussiness_partner_id',$id)->get()
    // return view('backend.bussinesspartner.bank', compact('bankdetails'));
}



    // public function edit($id)
    // {
    //     $userdata = InternalUser::where('user_id', $id)->first();
    //     $role = Role::get(['id', 'name']);
    //     return view('backend.internalusers.edit', compact('userdata', 'role'));
    // }
    // public function update(Request $request)
    // {
    //     $update_data = $request->all();
    //     unset($update_data['_token']);
    //     //  dd($update_data);
    //     $data = InternalUser::where('user_id', $request->user_id)->get();
    //     if (count($data) > 0) {
    //         // $userdata = InternalUser::where('user_id', $request->id)->update($update_data);
    //         $userdata = InternalUser::where('user_id', $request->user_id)->first();

    //         $userdata->fill($request->all());
    //         if ($userdata->save()) {
    //             return redirect('/admin/internalusers')->with('success', 'User Has Been Updated');
    //         }
    //     }
    // }
} //end of class
