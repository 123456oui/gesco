<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    
    public function setVisibleMenu($idMenu)
    {
        $menu = Menu::find($idMenu);
        //dd($menu);
        if($menu->visible){
            $menu->visible = 0;
        }else{
            $menu->visible = 1;
        }
        $menu->save();
    }

    public function getLocaliteData(Request $request)
{
    // Récupérer l'ID passé par la requête AJAX
    $localiteId = $request->get('id');

    // Si l'ID est présent, récupérer les données des localités enfants
    if ($localiteId) {
        // Récupérer les localités dont le parent_id correspond à localiteId
        $localites = Localite::where('parent_id', $localiteId)->get(); // Assurez-vous que 'parent_id' est un champ valide dans la table Localite

        if ($localites->isEmpty()) {
            // Si aucune localité n'est trouvée
            return response()->json([
                'success' => false,
                'message' => 'Aucune localité trouvée pour ce parent.'
            ]);
        } else {
            // Retourner les localités sous forme de tableau
            $localiteData = $localites->map(function($localite) {
                return [
                    'id' => $localite->localite_id,
                    'nom' => $localite->nomLocalite
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $localiteData
            ]);
        }
    } else {
        // Si l'ID n'est pas passé dans la requête
        return response()->json([
            'success' => false,
            'message' => 'Aucun ID fourni.'
        ]);
    }
}


}
