<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class PokemonTCGController extends Controller
{
     public function index()
    {
        $cards = Card::all();
        return response()->json($cards);
    }

     public function show($id)
    {
        $card = Card::findOrFail($id);
        return response()->json($card);
    }

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'rarity' => 'required',
            'total' => 'required',
            'price' => 'required',
            'images' => 'required',
            'is_active' => 'boolean',
        ]);

        $card = Card::create($request->all());

        return response()->json($card, 201);
    }

      public function update(Request $request, $id)
    {
        $request->validate([
             'name' => 'required|string',
            'rarity' => 'required',
            'total' => 'required',
            'price' => 'required',
            'images' => 'required',
            'is_active' => 'boolean',
        ]);

        $card = Card::findOrFail($id);
        $card->update($request->all());

        return response()->json($card, 200);
    }

      public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return response()->json(['message' => 'Card deleted successfully']);
    }

     public function search(Request $request)
    {
        $query = $request->input('query');
        $cards = Card::where('name', 'like', '%' . $query . '%')
                     ->orWhere('rarity', 'like', '%' . $query . '%')
                     ->get();

        return response()->json($cards);
    }

    


     public function activateCard($id)
    {
        $card = Card::findOrFail($id);
        $card->update(['is_active' => true]);

        return response()->json(['message' => 'Card activated successfully']);
    }

     public function deactivateCard($id)
    {
            $card = Card::findOrFail($id);
            $card->update(['is_active' => false]);

            return response()->json(['message' => 'Card deactivated successfully']);
    }

}
