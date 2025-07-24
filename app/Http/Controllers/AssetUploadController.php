<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetUploadController extends Controller
{
    public function index()
    {
        $images = Upload::where('type', 'image')->get();
    $videos = Upload::where('type', 'video')->get();
    $shorts = Upload::where('type', 'short')->get();

    return view('backend.uploadview.index', compact('images', 'videos', 'shorts'));
    }

    public function create()
    {
        return view('backend.uploadview.create');
    }

    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|in:image,video,short',
        'file' => 'required|file|max:20480', // max 20MB
        'subtype' => 'nullable|string|in:cover,appthumbnail,webthumbnail' // only applicable for images
    ]);

    $file = $request->file('file');
    $extension = $file->getClientOriginalExtension();
    $filename = Str::uuid() . '.' . $extension;

    // Determine storage folder by type
    $baseFolder = match ($request->type) {
        'image' => 'uploads/images',
        'video' => 'uploads/videos',
        'short' => 'uploads/shorts',
    };

    // Append subtype folder for images
    if ($request->type === 'image' && $request->filled('subtype')) {
        $baseFolder .= '/' . $request->subtype;
    }

    // Store the file
    $path = $file->storeAs($baseFolder, $filename, 'public');

    // Save to DB
    Upload::create([
        'title' => $request->title,
        'type' => $request->type,
        'path' => 'storage/' . $path,
    ]);


        return redirect()->route('uploadview.index')->with('success', 'Asset uploaded successfully.');
    }

    public function destroy($id)
    {
        $upload = Upload::findOrFail($id);

        // Remove physical file
        if ($upload->path && file_exists(public_path($upload->path))) {
            unlink(public_path($upload->path));
        }

        $upload->delete();
        return redirect()->route('uploadview.index')->with('success', 'Asset deleted successfully.');
    }
}
