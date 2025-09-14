<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Certification::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('issuing_authority', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('validity')) {
            if ($request->validity === 'valid') {
                $query->valid();
            } elseif ($request->validity === 'expired') {
                $query->where('expires_at', '<', now());
            }
        }

        $certifications = $query->orderBy('sort_order')->paginate(10);

        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:certifications,slug',
            'description' => 'nullable|string',
            'issuing_authority' => 'required|string|max:255',
            'certificate_number' => 'nullable|string|max:255',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:issued_at',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certifications', 'public');
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('certifications/documents', 'public');
        }

        Certification::create($data);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification created successfully.');
    }

    public function show(Certification $certification)
    {
        return view('admin.certifications.show', compact('certification'));
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:certifications,slug,' . $certification->id,
            'description' => 'nullable|string',
            'issuing_authority' => 'required|string|max:255',
            'certificate_number' => 'nullable|string|max:255',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:issued_at',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($certification->image) {
                Storage::disk('public')->delete($certification->image);
            }
            $data['image'] = $request->file('image')->store('certifications', 'public');
        } elseif ($request->has('remove_image') && $certification->image) {
            Storage::disk('public')->delete($certification->image);
            $data['image'] = null;
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            if ($certification->document) {
                Storage::disk('public')->delete($certification->document);
            }
            $data['document'] = $request->file('document')->store('certifications/documents', 'public');
        } elseif ($request->has('remove_document') && $certification->document) {
            Storage::disk('public')->delete($certification->document);
            $data['document'] = null;
        }

        $certification->update($data);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image) {
            Storage::disk('public')->delete($certification->image);
        }
        if ($certification->document) {
            Storage::disk('public')->delete($certification->document);
        }

        $certification->delete();

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification deleted successfully.');
    }

    public function toggleStatus(Certification $certification)
    {
        $certification->update(['is_active' => !$certification->is_active]);

        return response()->json([
            'success' => true,
            'status' => $certification->is_active
        ]);
    }
}
