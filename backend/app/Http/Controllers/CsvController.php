<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class CsvController extends Controller
{
    public function index(): JsonResponse
{
    $files = Storage::files('app');
    $csvFiles = array_filter($files, fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'csv');

    // Extraer solo los nombres de archivo sin la ruta
    $fileNames = array_map(function($file) {
        return str_replace('app/', '', $file); // Elimina 'app/' del nombre
    }, array_values($csvFiles));

    return response()->json([
        'mensaje' => 'Listado de ficheros',
        'contenido' => $fileNames,
    ], 200);
}

    public function store(Request $request): JsonResponse
    {
        $filename = $request->input('filename');
        $content = $request->input('content');

        if (!$filename || !$content) {
            return response()->json(['mensaje' => 'Faltan parámetros'], 422);
        }

        if (Storage::exists($filename)) {
            return response()->json(['mensaje' => 'El fichero ya existe'], 409);
        }

        Storage::put("app/$filename", $content);

        return response()->json(['mensaje' => 'Guardado con éxito'], 200);
    }

    public function show(string $id)
{
    $path = "app/{$id}";

    if (!Storage::exists($path)) {
        return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
    }

    $content = Storage::get($path);
    
    // Convert content to array (supporting both \n and \r\n)
    $rows = preg_split('/\r\n|\n/', trim($content));
    
    if (empty($rows)) {
        return response()->json([
            'mensaje' => 'El fichero está vacío',
            'contenido' => []
        ]);
    }

    $data = [];
    foreach ($rows as $row) {
        // Handle quoted values and commas within quotes
        preg_match_all('/"([^"]*)"|(([^,]*))/', $row, $matches);
        $fields = [];
        foreach ($matches[0] as $match) {
            $field = trim($match, '"');
            if ($field !== '') {
                $fields[] = $field;
            }
        }
        if (!empty($fields)) {
            $data[] = $fields;
        }
    }

    if (count($data) < 2) {
        return response()->json([
            'mensaje' => 'El fichero no contiene datos válidos',
            'contenido' => []
        ]);
    }

    // First row as headers, rest as data
    $headers = array_shift($data);
    $formattedData = array_map(function($row) use ($headers) {
        return array_combine($headers, array_pad($row, count($headers), ''));
    }, $data);

    return response()->json([
        'mensaje' => 'Fichero leído con éxito',
        'contenido' => $formattedData
    ]);
}
    


public function update(Request $request, string $id)
{
    $path = "app/{$id}";

    if (!Storage::exists($path)) {
        return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
    }

    $content = $request->input('content');

    if (!$content || !is_string($content)) {
        return response()->json(['mensaje' => 'Contenido inválido'], 422);
    }

    Storage::put($path, $content);

    return response()->json(['mensaje' => 'Fichero actualizado exitosamente']);
}


public function destroy(string $id)
{
    $path = "app/{$id}";

    if (!Storage::exists($path)) {
        return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
    }

    Storage::delete($path);

    return response()->json(['mensaje' => 'Fichero eliminado exitosamente']);
}

}