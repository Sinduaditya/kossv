<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        // dd($rooms);
        return view('backend.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('backend.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image',
            'tipe_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required|boolean',
            'deskripsi' => 'required|string',
            'date_added' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        Room::create($data);

        return redirect()->route('room.index')->with('success', 'Room created successfully.');
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('backend.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'sometimes|image',
            'tipe_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required|boolean',
            'deskripsi' => 'required|string',
            'date_added' => 'required|date',
        ]);

        $room = Room::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Delete the old image
            if ($room->gambar && file_exists(public_path('images/' . $room->gambar))) {
                unlink(public_path('images/' . $room->gambar));
            }

            // Upload the new image
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        $room->update($data);

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }
}
