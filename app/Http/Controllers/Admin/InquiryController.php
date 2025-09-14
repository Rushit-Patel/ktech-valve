<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    protected array $middleware = [
        'auth',
        'admin',
    ];
    public function index(Request $request)
    {
        $query = Inquiry::with('product');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('company', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $inquiries = $query->latest()->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('product');
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,closed'
        ]);

        $inquiry->update(['status' => $request->status]);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark_completed,mark_pending',
            'inquiries' => 'required|array',
            'inquiries.*' => 'exists:inquiries,id'
        ]);

        $inquiries = Inquiry::whereIn('id', $request->inquiries);

        switch ($request->action) {
            case 'delete':
                $inquiries->delete();
                $message = 'Selected inquiries deleted successfully.';
                break;
            case 'mark_completed':
                $inquiries->update(['status' => 'completed']);
                $message = 'Selected inquiries marked as completed.';
                break;
            case 'mark_pending':
                $inquiries->update(['status' => 'pending']);
                $message = 'Selected inquiries marked as pending.';
                break;
        }

        return redirect()->route('admin.inquiries.index')
            ->with('success', $message);
    }
}
