<?php

namespace App\Http\Controllers;

use App\Models\Commende;
use Illuminate\Http\Request;

class CommendeController extends Controller
{
    public function index()
    {
        $commandes = Commende::all();
        return view('commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commende::findOrFail($id);
        return response()->json($commande);
    }

    public function destroy($id)
    {
        $commande = Commende::findOrFail($id);

        if ($commande->status === 'en_preparation') {
            $commande->delete();
            return response()->json(['success' => 'Commande supprimée avec succès.']);
        }

        return response()->json(['error' => 'Impossible de supprimer la commande.'], 400);
    }

    public function update(Request $request, $id)
    {
        $commande = Commende::findOrFail($id);
        $commande->date_renvoi = $request->date_renvoi;
        $commande->save();

        return response()->json(['success' => 'Date de renvoi mise à jour avec succès.']);
    }
}
