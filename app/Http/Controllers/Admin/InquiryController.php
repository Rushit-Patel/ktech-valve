<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class InquiryController extends BaseController
{
    public function index(Request $request)
    {
        $query = Inquiry::with(['product']);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('company', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('product')) {
            $query->where('product_id', $request->product);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $inquiries = $query->latest()->paginate(15);
        $products = Product::active()->orderBy('name')->get();

        return view('admin.inquiries.index', compact('inquiries', 'products'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('product');
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,quoted,closed',
            'admin_notes' => 'nullable|string'
        ]);

        $data = ['status' => $request->status];

        if ($request->filled('admin_notes')) {
            $data['admin_notes'] = $request->admin_notes;
        }

        if ($request->status === 'contacted' && $inquiry->status !== 'contacted') {
            $data['contacted_at'] = now();
        }

        $inquiry->update($data);

        return $this->successResponse('Inquiry status updated successfully!');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return $this->successResponse('Inquiry deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark_contacted,mark_quoted,mark_closed',
            'inquiries' => 'required|array',
            'inquiries.*' => 'exists:inquiries,id'
        ]);

        $inquiries = Inquiry::whereIn('id', $request->inquiries);

        switch ($request->action) {
            case 'delete':
                $inquiries->delete();
                $message = 'Selected inquiries deleted successfully!';
                break;
            case 'mark_contacted':
                $inquiries->update(['status' => 'contacted', 'contacted_at' => now()]);
                $message = 'Selected inquiries marked as contacted!';
                break;
            case 'mark_quoted':
                $inquiries->update(['status' => 'quoted']);
                $message = 'Selected inquiries marked as quoted!';
                break;
            case 'mark_closed':
                $inquiries->update(['status' => 'closed']);
                $message = 'Selected inquiries marked as closed!';
                break;
        }

        return $this->successResponse($message);
    }

    public function export(Request $request)
    {
        $query = Inquiry::with('product');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $inquiries = $query->get();

        $filename = 'inquiries_' . now()->format('Y_m_d_H_i_s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($inquiries) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Company', 'Subject', 
                'Product', 'Status', 'Created At', 'Contacted At'
            ]);

            // Add data rows
            foreach ($inquiries as $inquiry) {
                fputcsv($file, [
                    $inquiry->id,
                    $inquiry->name,
                    $inquiry->email,
                    $inquiry->phone,
                    $inquiry->company,
                    $inquiry->subject,
                    $inquiry->product ? $inquiry->product->name : 'N/A',
                    ucfirst($inquiry->status),
                    $inquiry->created_at->format('Y-m-d H:i:s'),
                    $inquiry->contacted_at ? $inquiry->contacted_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}