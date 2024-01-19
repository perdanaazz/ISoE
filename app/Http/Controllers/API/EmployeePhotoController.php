<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\EmployeePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeePhotoController extends Controller
{
    public function photoUpload(Request $request)
    {
        try {
            $image = $request->file('file');
            $imageName = null;

            if ($request->file('file')) {
                $imageName = $request->newFileName;
                $path = $request->file('file')->storeAs('employee_photo', $imageName, 'public');

                $store = EmployeePhoto::create([
                    'rand'        => $request->rand,
                    'image_name'  => $imageName,
                    'path'        => $path,
                    'employee_id' => $request->employee_id,
                ]);

                return ResponseFormatter::success($store, 'Success create data');
            }

            return ResponseFormatter::error('Failed create data', 500);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function photoDelete(string $nama)
    {
        try {
            $check = EmployeePhoto::where('image_name', $nama)->first();

            if (!$check) {
                return ResponseFormatter::error('Data not found', 404);
            }

            $check->delete();

            if (Storage::disk('public')->exists('employee_photo/' . $nama)) {
                Storage::disk('public')->delete('employee_photo/' . $nama);
            }

            return ResponseFormatter::success($nama, 'Success delete data');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
