<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait deleteDBStorage
{
    public function deleteDBS($data)
    {
        if ($data->isNotEmpty()) {
            foreach ($data as $ep) {
                // Delete in storage
                if (Storage::disk('public')->exists('employee_photo/' . $ep->image_name)) {
                    Storage::disk('public')->delete('employee_photo/' . $ep->image_name);
                }
                // Delete in database
                $ep->delete();
            }

            return 'Success delete data.';
        }

        return 'Data not found or not valid.';
    }
}
