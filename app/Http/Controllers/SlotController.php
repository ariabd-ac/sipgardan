<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;

class SlotController extends Controller
{
    public function update(Request $request, $id){

        $validate = $this->validate($request, ['capasity' => 'required'], ['required' => 'Form ini harus disi']);

        $slot = Slot::findOrFail($id);

        $slot->update([
            'capasity' => $request->capasity,
        ]);

        return redirect()->route("parking")->with("success", "Total parkir berhasil diubah");
    }
}
