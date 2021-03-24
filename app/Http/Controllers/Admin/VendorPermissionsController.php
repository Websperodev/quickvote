<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;
use Response;
use App\User;
use App\Models\ModulesList;
use App\Models\VendorPermissions;
use App\Models\ModelHasRoles;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class VendorPermissionsController extends Controller {

    function index($id) {
        $modules = ModulesList::where('status', '1')->get();
        $promissions = [];
        $promission = '';
        $vendor_id = $id;
//        print_r($modules); die;
        foreach ($modules as $key => $mod) {
//            print_r($mod->name); die;
            $vendorPermissions = VendorPermissions::where(['vendor_id' => $id, 'modul_id' => $mod->id])->first();

            if (empty($vendorPermissions)) {
                $promission = array(
                    'id' => $mod->id,
                    'name' => $mod->name,
                    'add' => '0',
                    'edit' => '0',
                    'view' => '0',
                    'delete' => '0',
                );
            } else {
                $promission = array(
                    'id' => $mod->id,
                    'name' => $mod->name,
                    'add' => $vendorPermissions->add,
                    'edit' => $vendorPermissions->edit,
                    'view' => $vendorPermissions->view,
                    'delete' => $vendorPermissions->delete,
                );
            }
            $promissions[] = $promission;
            $promission = [];
        }

        return view('admin.user.vendorPermission', compact('promissions', 'vendor_id'));
    }

    function addvendorPermissions(Request $request) {
        $data = $request->all();
        unset($data['_token']);

        try {
            foreach ($data as $row) {

                $check = VendorPermissions::where(['vendor_id' => $row['vendor_id'], 'modul_id' => $row['id']])->first();

                $permissions = new VendorPermissions;
                if (!empty($check)) {
                    $permissions = $permissions::find($check->id);
                }
                $permissions->modul_id = $row['id'];
                $permissions->vendor_id = $row['vendor_id'];
//                echo '<pre>';
//                print_r($permissions);
//                die;
                if (isset($row['add'])) {
                    $permissions->add = '1';
                } else {
                    $permissions->add = '0';
                }
                if (isset($row['edit'])) {
                    $permissions->edit = '1';
                } else {
                    $permissions->edit = '0';
                }

                if (isset($row['view'])) {
                    $permissions->view = '1';
                } else {
                    $permissions->view = '0';
                }
                if (isset($row['delete'])) {
                    $permissions->delete = '1';
                } else {
                    $permissions->delete = '0';
                }

//                $check = VendorPermissions::where(['vendor_id' => $row['vendor_id'], 'modul_id' => $row['id']])->first();
                if (!empty($check)) {
//                    echo "no";
//                    die;
                    $permissions->update();
                } else {

                    $permissions->save();
                }
            }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.text', 'Permission has been updated successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', $e->getMessage());
            return redirect()->back();
        }
    }

}
